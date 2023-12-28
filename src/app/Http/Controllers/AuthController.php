<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
{
    use RegistersUsers;
    use LogoutUsers;

    protected $redirectTo = '/thanks';

    public function showLoginForm()
    {
    return view('auth.login');
    }

    public function showRegisterForm()
    {
    return view('auth.register');
    }

    public function login()
    {
    return view('auth.login');
    }

    public function thanks()
    {
        return view('auth.thanks'); // 'thanks.blade.php' ビューを表示
    }
}
