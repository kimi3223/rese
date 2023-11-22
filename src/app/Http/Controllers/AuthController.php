<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
{
    public function showLoginForm()
    {
    return view('auth.login');
    }

    protected function register()
    {
        return view('auth.thanks');
    }

    public function showRegisterForm()
    {
    return view('auth.register');
    }

    public function login()
    {
    return view('auth.login');
    }
}
