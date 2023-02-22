<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;

class HomeController
{
    public function index(): void
    {
        View::render('Home/index', [
            'title' => 'Gudang Sortir'
        ]);
    }
}