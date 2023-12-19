<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Reservation;

class UserController extends Controller
{
    public function showMyPage()
    {
        // ユーザーのお気に入り店舗を取得
        $user = auth()->user();
        $favoriteShops = $user->favoriteShops()->with('shop')->get();
        $userInfo = Auth::user();
        $reservation = Reservation::where('user_id', $user->id)->first();

        $favoriteShops = $favoriteShops->map(function ($favorite) {
        return $favorite->load('shop');
        });

        // 他のショップの取得（例：すべてのショップを取得）
        $allShops = Shop::all();

        return view('user.mypage', [
            'favoriteShops' => $favoriteShops,
            'userInfo' => $userInfo,
            'reservation' => $reservation,
            'allShops' => $allShops,
        ]);
    }
}
