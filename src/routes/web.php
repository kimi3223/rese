<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteShopController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ReservationController;

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
Route::get('/search', [ShopController::class, 'search'])->name('search');

// 飲食店詳細表示（ログインが必要）
Route::middleware('auth')->group(function () {
    Route::get('/shops/detail/{shop_id}', [ShopController::class, 'detail'])->name('shops.detail');
    Route::get('/mypage', [UserController::class, 'showMyPage'])->name('user.mypage');
    Route::get('/shops/done', [ShopController::class, 'done'])->name('shops.done');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/shops/show/{id}', [ShopController::class, 'show'])->name('shops.show');
    Route::delete('/reservations/{reservationId}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::post('/favoriteshop/store', [FavoriteShopController::class, 'store'])->name('favoriteshop.store');
    Route::get('/favorites/{id}', [FavoriteShopController::class, 'show'])->name('favorites.show');
    Route::delete('/favoriteshop/{favorite}', [FavoriteShopController::class, 'destroy'])->name('favoriteshop.destroy');
    Route::post('/favorites/toggle/{id}', [FavoriteShopController::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::get('/done', [ReservationController::class, 'done'])->name('reservation.done');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
    Route::view('/score', 'shops.score')->name('score');
    Route::post('/reservations/{reservation}/rate', 'ReservationController@rate')->name('reservations.rate');
});

// ユーザー登録
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Auth::routes();
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');