<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function thanks()
    {
        return view('thanks'); // 'thanks.blade.php' ビューを表示
    }
}
