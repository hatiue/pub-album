<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bind;
use App\Http\Requests\UpdateRequest;
use App\Services\PageService;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    // 閲覧用ページ、indexからのリンク
    public function page($userId, PageService $pageService)
    {
        $id = $userId ; // ビュー・ルートから受け取った 

        $rows = $pageService->getCards($id); // rowsにはEloquentコレクションを配列化したものが入る
        $userName = $pageService->getUserName($id);
        return view('cards_read')->with('rows', $rows)->with('userName', $userName);
    }

    // 検索結果一覧を表示するページ
    public function searchResult(PageService $pageService, UpdateRequest $request)
    {
        if($request->searchUser()) {
            $users = $pageService->searchName($request->searchUser());
            $id = $pageService->searchId($request->searchUser());
            if($users || $id) {
                //return view('index')->with('users', $users)->with('id', $id);
                return view('index')->with(['users' => $users, 'id' => $id]);
            } else {
                return back()->with('searchMessage', '該当するユーザーはいませんでした…');
            }
        } else {
            return back();
        }
    }

    // 閲覧用ページ、ランダム版
    public function randPage(PageService $pageService)
    {
        $getUserId = $pageService->randomValidUsers();
        $rows = $pageService->getCards($getUserId);
        $userName = $pageService->getUserName($getUserId);
        return view('cards_read')->with('rows', $rows)->with('userName', $userName);
    }

    public function getUserData($userId)
    {
        $userData = Bind::where('user_id', $userId)->firstOrFail();
        return $userData;
    }

    public function getComposition($userId, $position)
    {
        $row = Bind::where('user_id', $userId)->where('position', $position)->firstOrFail();
        $composition = $row->composition;
        return $composition;
    }

    // 「ページをつくる」ボタンの挙動
    public function addRows(Request $request, int $userId)
    {
        $userId = auth()->id();
        $rowsCount = DB::table('binds')->where('user_id', $userId)->count();
        if($rowsCount === 0) { // まだない状態
            for($i = 1; $i <= 9; $i++) {
                DB::table('binds')->insert([
                    ['position' => $i, 'created_at' => now(), 'updated_at' => now(), 'user_id' => $userId],
                ]);
            }
            return redirect()->route('mypage', ['userId' => $userId])->with('message', 'ページを作成しました！');
        } elseif($rowsCount !== 9) { // データ数が0か9以外のおかしな状態
            return back()->with('message', 'あなたのデータは今不思議な状態にあります。管理者に連絡してください！');
        } else {
            return redirect()->route('mypage', ['userId' => $userId]);
        }
    }

    // testビューで何かを試すとき用
    public function test(PageService $pageService, UpdateRequest $request)
    {
        return view('test');
    }
}
