<?php

namespace App\Http\Middleware;

use App\Services\Category\CategoryService;
use App\Services\Session\SessionService;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryMiddleware
{

    private SessionService $sessionService;
    private CategoryService $categoryService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->sessionService = app()->make(SessionService::class);
        $this->categoryService = app()->make(CategoryService::class);
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): RedirectResponse
    {
        $user = $this->sessionService->current();
        $path = explode("/", $request->path());
        $categoryId = end($path);
        $category = $this->categoryService->getCategory($categoryId, $user->id);
        if ($category == null) {
            return redirect('/dashboard/category');
        }
        return $next($request);
    }
}
