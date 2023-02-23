<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;

class DashboardController
{
    public function dashboard(): void
    {
        View::render('Dashboard/dashboard', []);
    }
}