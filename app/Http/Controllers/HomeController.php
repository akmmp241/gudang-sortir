<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        return view('Home.home');
    }
}
