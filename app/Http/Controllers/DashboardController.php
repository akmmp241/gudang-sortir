<?php

namespace App\Http\Controllers;

use App\Services\Session\SessionService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private SessionService $sessionService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->sessionService = app()->make(SessionService::class);
    }

    public function dashboard(): View
    {
        $user = $this->sessionService->current();
        return view('Dashboard.dashboard', [
            'title' => 'dashboard',
            'user' => $user
        ]);
    }
}
