<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showMyPage()
    {
        // ここにマイページの表示に関するロジックを追加
        return view('user.mypage');
    }
}
