<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 飲食店一覧表示
Route::get('/', [ShopController::class, 'index']);
Route::get('/create-shops', [ShopController::class, 'createShops']);

Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');

// 飲食店詳細表示（ログインが必要）
Route::middleware('auth')->group(function () {
    Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
    Route::get('/mypage', [UserController::class, 'showMyPage']);
    Route::get('/done', [ReservationController::class, 'showReservationDonePage']);
});

// ユーザー登録
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Auth::routes();
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');

Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
