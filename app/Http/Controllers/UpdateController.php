<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\Bind;
use App\Models\Image;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    // ログイン済みユーザーの自分のページ
    public function mypage(PageService $pageService)
    {
        $userId = auth()->id();
        $rows = $pageService->getCards($userId);
        $userName = $pageService->getUserName($userId);
        return view('cards_update')->with('rows', $rows)->with('userName', $userName);
    }

    public function card(UpdateRequest $request)
    {
        // p86のやつ、値を取得するメソッド？　ならmypage()でいいと思う
        $userId = auth()->id();
        $position = $request->position(); // 編集する行を取得
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        return view('card_solo')->with('card', $card);
    }

    /*
    // この下2つのメソッドに分割した
    public function update(UpdateRequest $request)
    {
        $userId = auth()->id();
        $position = $request->position();
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        // ここからp236抜き出し
        $image = $request->image(); // アップロードした画像そのものの事でいいのか？
        Storage::putFile('public/images', $image);
        $imgurl = $image->hashName(); // ここと
        $card->imgurl = $imgurl; // この2行合ってる？
        $card->composition = $request->composition();
        $card->save();
        //return redirect()->route('card', ['userId' => $userId, 'position' => $position]) // getになる
        //return back() // getになる
        return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307)
            ->with('update.success', '更新しました');
    }
    */

    public function updateComposition(UpdateRequest $request)
    {
        $userId = auth()->id();
        $position = $request->position();
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        $card->composition = $request->composition();
        $card->save();
        return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307)
            ->with('update.success', '本文を更新しました');
    }

    public function updateImage(UpdateRequest $request)
    {
        $userId = auth()->id();
        $position = $request->position();
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        $image = $request->image();
        Storage::putFile('public/images', $image); // The file "public/images" does not exist
        $imgurl = $image->hashName(); // ここと
        $card->imgurl = $imgurl; // この2行合ってる？
        $card->save();
        return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307)
            ->with('update.success', '画像を更新しました');
    }

    public function delete(UpdateRequest $request)
    {
        // deleteといいつつ、行の削除は行いません
        $userId = auth()->id();
        $position = $request->position();
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        $card->imgurl = "";
        $card->composition = "";
        $card->save();
        return redirect()->route('mypage', ['userId' => $userId])
            ->with('delete.success', "{$position}枚目を削除しました。");
    }

    
}
