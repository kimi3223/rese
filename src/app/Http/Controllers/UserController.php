<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FavoriteShop;
use App\Models\Shop;
use App\Models\Reservation;

class UserController extends Controller
{
    public function index()
    {
        // ログインしているユーザーの予約データを取得
        $user = auth()->user();
        $reservations = $user->reservations;
        $favoriteShops = $user->favoriteShops()->with('shop')->get();

        return view('user.mypage', [
            'reservations' => $reservations,
            'favoriteShops' => $favoriteShops,
        ]);
    }

    public function showMyPage()
    {
        // ユーザーのお気に入り店舗を取得
        $user = auth()->user();
        $favoriteShops = $user->favoriteShops()->with('shop')->get();

        // ユーザー情報を取得
        $userInfo = Auth::user();

        // ユーザーの予約データを取得
        $reservations = Reservation::where('user_id', auth()->id())->get();

        // 他のショップの取得（例：すべてのショップを取得）
        $allShops = Shop::all();

        return view('user.mypage', [
            'favoriteShops' => $favoriteShops,
            'userInfo' => $userInfo,
            'reservations' => $reservations,
            'allShops' => $allShops,
        ]);
    }
}
