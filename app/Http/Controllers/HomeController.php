<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bind;
use App\Models\User;
use App\Services\PageService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    // 閲覧用ページ
    public function page(PageService $pageService, $userId)
    {
        $getuserId = $userId; // いずれランダムに
        $rows = $pageService->getCards($getuserId); // rowsにはEloquentコレクションを配列化したのが入ってる
        $userName = $pageService->getUserName($userId);
        return view('cards_read')->with('rows', $rows)->with('userName', $userName);
    }



    public function getUserData($userId)
    {
        $userData = Bind::where('user_id', $userId)->firstOrFail();
        return $userData;
    }

    public function getComposition($userId, $position)
    {
        // ToDo:サービスクラスからの取得に切り替えて動作を確認
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

    /*
    // 行挿入と本人ページへの遷移を一括にする前
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
            return back()->with('message', 'ページを作成しました！');
        } elseif($rowsCount !== 9) { // データ数が0か9以外のおかしな状態
            return back()->with('message', 'あなたのデータは今不思議な状態にあります。管理者に連絡してください！');
        } else {
            // return back()->with('message', 'ページは作成済みでが、実装していないので少し待ってください！');
            // postでアクセスしたいのだが
            return redirect()->route('mypage', ['userId' => $userId]);
        }
    }
    */

    // testビューで何かを試すとき用のメソッド
    public function test(PageService $pageService)
    {
        $rows = Bind::where('user_id', 1)->get();
        return view('test')->with('rows', $rows);
    }
}
