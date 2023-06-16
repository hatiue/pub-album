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

    public function search($input)
    {
        // IDかユーザー名で検索してIDを返す、検索は名前優先
        // 1人限定（いずれ検索結果一覧ページ追加）
        $inputWord = $input;
        $nameSearch = User::where('name', $inputWord)->get();
        $userId = $nameSearch->value('id');

        if($userId == false) {
            $idSearch = User::where('id', $inputWord)->get();
            $userId = $idSearch->value('id');
        }

        return $userId;
    }

    public function searchName($input)
    {
        // ユーザー名での検索結果を全て取得する
        if($input != null) {
            $word = "%" . $input . "%"; // エスケープについては未 addcslaches()等参照
            $nameSearch = User::where('name', 'LIKE', $word)->select('id', 'name')->get();
            $nameSearchResults = $nameSearch->toArray();
            return $nameSearchResults;
        }
        return null;
    }
    public function searchId($input)
    {
        // IDでの検索結果を取得する　完全一致のみ
        if($input != null) {
            $idSearch = User::where('id', $input)->select('id', 'name')->get();
            $idSearchResults = $idSearch->toArray();
            return $idSearchResults;
        }
        return null;
    }

    public function randomValidUsers()
    {
        // imgurlとcomposition合計18個のうち1つでも空白でなければ（デフォルトでなければ）有効とみなす
        $collection = Bind::whereNotNull('imgurl')->orWhereNotNull('composition')->pluck('user_id');
        $uniqueId = $collection->unique();
        $randomId = $uniqueId->random(1)->toArray(); // toArray()を追加
        return $randomId[0];

        //$collection = Bind::whereNotNull('imgurl')->orWhereNotNull('composition')->select('user_id');
        //$array = $collection->all();
    }

    public function updateCard(UpdateRequest $request)
    {
        // Updateコントローラからコピペしたが、処理はあちらで行っている
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