<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 例: usersテーブルからデータを取得
        $data = DB::table('users')->get();

        return view('admin.dashboard', compact('data'));
    }
}
