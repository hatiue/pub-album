<?php

namespace App\Services;

use App\Models\Bind;
use App\Models\User;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PageService
{
    
    public function getCards(int $userId)
    {
        // 9行分取得
        $rows = Bind::where('user_id', $userId)->get()->toArray();
        return $rows;
    }

    public function getImgurl($userId, $position)
    {
        // 画像のパスを取得
        $row = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        $imgurl = $row->imgurl;
        return $imgurl;
    }

    public function getComposition($userId, $position)
    {
        // 本文のみ取得
        $row = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        $composition = $row->composition;
        return $composition;
    }

    public function getUserName(int $userId)
    {
        // 名前のみ取得
        $row = User::select('name')->where('id', $userId)->firstOrFail();
        $userName = $row->name;
        return $userName;
    }

    public function updateCard(UpdateRequest $request)
    {
        // Updateコントローラからコピペしたが、処理はあっちのままでいいかも
        $userId = auth()->id();
        $position = $request->position();
        $card = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        // $card->imgurl =  // 画像関連未着手
        $card->composition = $request->composition();
        $card->save();
        //return redirect()->route('card', ['userId' => $userId, 'position' => $position]) // getになる
        //return back() // getになる
        return redirect(route('card', ['userId' => $userId, 'position' => $position]), 307)
            ->with('update.success', '更新しました');
    }
}