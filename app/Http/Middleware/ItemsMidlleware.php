<?php

namespace App\Http\Middleware;

use App\Repositories\Items\ItemsRepository;
use App\Repositories\Session\SessionRepository;
use App\Services\Session\SessionService;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemsMidlleware
{
    private ItemsRepository $itemsRepository;
    private SessionService $sessionService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->itemsRepository = app()->make(ItemsRepository::class);
        $this->sessionService = app()->make(SessionService::class);
    }


    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->sessionService->current();
        $path = explode('/', $request->path());
        $itemId = end($path);

        $item = $this->itemsRepository->getItemsByIdItems($itemId, $user->id, false);
        return $next($request);
    }
}
