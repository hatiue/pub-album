<?php

namespace App\Services;

use App\Models\Bind;
use App\Models\User;

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

    /* 下記searchName()とsearchId()を作成したため不要に
    public function search($input)
    {
        // IDかユーザー名で検索してIDを返す、検索は名前優先で1件のみ取得
        $inputWord = $input;
        $nameSearch = User::where('name', $inputWord)->get();
        $userId = $nameSearch->value('id');

        if($userId == false) {
            $idSearch = User::where('id', $inputWord)->get();
            $userId = $idSearch->value('id');
        }

        return $userId;
    }
    */

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
    }

}