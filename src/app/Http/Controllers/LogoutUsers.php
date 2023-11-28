<?php

namespace App\Http\Controllers;

trait LogoutUsers
{
    public function logout()
    {
        // ログアウトのロジック
        auth()->logout(); // 例: Laravelのデフォルトのログアウト処理
        return redirect('/');
    }
}
