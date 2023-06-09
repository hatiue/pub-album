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
// 閲覧用
Route::get('/pub-album/page/user-{userId}', [HomeController::class, 'page'])
    ->name('page')
    ->where('userId', '[0-9]+');
// 本人用
Route::get('/pub-album/mypage/user-{userId}', [UpdateController::class, 'mypage'])
    ->middleware('auth')
    ->name('mypage')
    ->where('userId', '[0-9]+');
// 1枚ずつ編集するページへ
Route::post('/pub-album/update/user-{userId}/{position}', [UpdateController::class, 'card'])
    ->middleware('auth')
    ->name('card')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}');
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
    ->name('updateComposition')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}');
// 画像の更新
Route::post('/pub-album/put-img/user-{userId}/{position}', [UpdateController::class, 'updateImage'])
    ->middleware('auth')
    ->name('updateImage')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}');
// 削除※nullで上書き
Route::post('/pub-album/delete/user-{userId}/{position}', [UpdateController::class, 'delete'])
    ->middleware('auth')
    ->name('delete')
    ->where('userId', '[0-9]+')
    ->where('position', '[0-9]{1}');

// ユーザ登録後テーブルに9行挿入、既にデータがある場合はroute('create')へリダイレクト
Route::post('/pub-album/user-{userId}', [HomeController::class, 'addRows'])
    ->middleware('auth')
    ->name('add')
    ->where('userId', '[0-9]+');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
