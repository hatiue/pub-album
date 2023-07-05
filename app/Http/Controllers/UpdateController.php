<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\Bind;
use App\Services\PageService;
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
        $userId = auth()->id();
        $position = $request->position(); // 編集する行を取得
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        return view('card_solo')->with('card', $card);
    }

    public function updateComposition(UpdateRequest $request)
    {
        $userId = auth()->id();
        $position = $request->position();
        if($request->composition()) {
            $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
            $card->composition = $request->composition();
            $card->save();
            return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307)
                ->with('update.success', '本文を更新しました');
        }
        return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307);
    }

    public function updateImage(UpdateRequest $request)
    {
        $userId = auth()->id();
        $position = $request->position();
        if($request->image()) {
            $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
            $image = $request->image();
            Storage::putFile('public/images', $image);
            $imgurl = $image->hashName();
            $card->imgurl = $imgurl;
            $card->save();
            return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307)
                ->with('update.success', '画像を更新しました');
        }
        return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307);
    }

    public function delete(UpdateRequest $request)
    {
        // nullでの上書き
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
