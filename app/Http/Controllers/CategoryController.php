<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationCategoryException;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceImplement;
use App\Services\Session\SessionService;
use App\Services\Session\SessionServiceImplement;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private CategoryServiceImplement $categoryService;
    private static SessionServiceImplement $sessionService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->categoryService = app()->make(CategoryService::class);
        self::$sessionService = app()->make(SessionService::class);
    }

    private static function ID_USER_IN_SESSION(): ?int
    {
        return self::$sessionService->current()->id;
    }

    public function category(): View
    {
        $user = self::$sessionService->current();
        $categories = $this->categoryService->allCategory(self::ID_USER_IN_SESSION(), true);
        return view('Dashboard.Category.category', [
            'categories' => $categories,
            'user' => $user
        ]);
    }

    public function addCategory(): View
    {
        $user = self::$sessionService->current();
        return view('Dashboard.Category.form-kategori', [
            'user' => $user
        ]);
    }

    public function postCategory(AddCategoryRequest $request): RedirectResponse
    {
        $request->id_user = self::ID_USER_IN_SESSION();
        try {
            $this->categoryService->addCategory($request);
            return redirect('/dashboard/category')->with(['message' => 'berhasil menambahkan kategori']);
        } catch (ValidationCategoryException $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function updateCategory(string $categoryId): View
    {
        $user = self::$sessionService->current();
        $category = $this->categoryService->getCategory($categoryId, self::ID_USER_IN_SESSION());
        return view('Dashboard.Category.update-category', [
            'category' => $category,
            'user' => $user
        ]);
    }

    public function postUpdateCategory(UpdateCategoryRequest $request, string $categoryId): RedirectResponse
    {
        $request->id_user = self::ID_USER_IN_SESSION();
        $request->category_id = $categoryId;
        try {
            $this->categoryService->updateCategory($request);
            return redirect('/dashboard/category')->with(['message' => 'berhasil mengubah kategori']);
        } catch (ValidationCategoryException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteCategory(DeleteCategoryRequest $request, string $categoryId): RedirectResponse
    {
        $request->id_user = self::ID_USER_IN_SESSION();
        try {
            $this->categoryService->deleteCategory($request, $categoryId, self::ID_USER_IN_SESSION());
            return redirect()->back()->with(['message' => 'berhasil menghapus category']);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
