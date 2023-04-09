<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationCategoryException;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceImplement;
use App\Services\Session\SessionService;
use App\Services\Session\SessionServiceImplement;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private CategoryServiceImplement $categoryService;
    private SessionServiceImplement $sessionService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->categoryService = app()->make(CategoryService::class);
        $this->sessionService = app()->make(SessionService::class);
    }

    public function category(): View
    {
        $user = $this->sessionService->current();
        $category = $this->categoryService->allCategory($user->id);
        return view('Dashboard.Category.category', [
            'category' => $category
        ]);
    }

    public function postCategory(AddCategoryRequest $request): RedirectResponse
    {
        $user = $this->sessionService->current();
        $request->id_user = $user->id;
        try {
            $this->categoryService->addCategory($request);
            return redirect()->back()->with(['message' => 'berhasil menambahkan kategori']);
        } catch (ValidationCategoryException $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function updateCategory(string $categoryId): View
    {
        $user = $this->sessionService->current();
        $category = $this->categoryService->getCategory($categoryId, $user->id);
        return view('Dashboard.Category.update', [
            'category' => $category
        ]);
    }

    public function postUpdateCategory(UpdateCategoryRequest $request, string $categoryId): RedirectResponse
    {
        $user = $this->sessionService->current();
        $request->id_user = $user->id;
        $request->category_id = $categoryId;
        try {
            $this->categoryService->updateCategory($request);
            return redirect('/dashboard/category')->with(['message' => 'berhasil mengubah kategori']);
        } catch (ValidationCategoryException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteCategory(string $categoryId): void
    {
        $user = $this->sessionService->current();
        $this->categoryService->deleteCategory($categoryId, $user->id);
    }
}
