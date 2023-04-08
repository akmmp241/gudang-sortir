<?php

namespace App\Http\Middleware;

use App\Services\Session\SessionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustLoginMiddleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = app()->make(SessionService::class);
    }

    public function handle(Request $request, Closure $next)
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            return redirect('/users/login');
        }
    }
}
