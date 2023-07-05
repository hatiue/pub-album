<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'test'])
    ->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pub-album', [HomeController::class, 'home'])
    ->name('home');
// 閲覧用、検索から
Route::get('/pub-album/page/user-{userId}', [HomeController::class, 'page'])
    ->where('userId', '[0-9]+')
    ->name('page');
// 閲覧用、ランダム版
Route::get('/pub-album/page/random-view', [HomeController::class, 'randPage'])
    ->name('randPage');
// 検索結果表示ページ
Route::get('/pub-album/page/search-result', [HomeController::class, 'searchResult'])
    ->name('search');
// 本人用
Route::get('/pub-album/mypage/user-{userId}', [UpdateController::class, 'mypage'])
    ->middleware('auth')
    ->where('userId', '[0-9]+')
    ->name('mypage');
// 1枚ずつ編集するページへ
Route::post('/pub-album/update/user-{userId}/{position}', [UpdateController::class, 'card'])
    ->middleware('auth')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}')
    ->name('card');
/*
// 一括更新
Route::post('/pub-album/put/user-{userId}/{position}', [UpdateController::class, 'update'])
    ->middleware('auth')
    ->name('update')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}');
*/
// 本文の更新
Route::post('/pub-album/put-comp/user-{userId}/{position}', [UpdateController::class, 'updateComposition'])
    ->middleware('auth')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}')
    ->name('updateComposition');
// 画像の更新
Route::post('/pub-album/put-img/user-{userId}/{position}', [UpdateController::class, 'updateImage'])
    ->middleware('auth')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}')
    ->name('updateImage');
// 削除※nullで上書き
Route::post('/pub-album/delete/user-{userId}/{position}', [UpdateController::class, 'delete'])
    ->middleware('auth')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}')
    ->name('delete');

// ユーザ登録後テーブルに9行挿入、既にデータがある場合はroute('create')へリダイレクト
Route::post('/pub-album/user-{userId}', [HomeController::class, 'addRows'])
    ->middleware('auth')
    ->where('userId', '[0-9]+')
    ->name('add');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
