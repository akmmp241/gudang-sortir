<?php

namespace App\Services\Category;

use App\Exceptions\ValidationCategoryException;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelEasyRepository\Service;
use App\Repositories\Category\CategoryRepository;

class CategoryServiceImplement extends Service implements CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws ValidationCategoryException
     */
    public function addCategory(AddCategoryRequest $request): void
    {
        AddCategoryRequest::validating($request, $this->categoryRepository);

        $category = new Category();
        $category->id_user = $request->id_user;
        $category->category_id = $request->category_id;
        $category->name_category = $request->name_category;
        $category->description = $request->description;

        $this->categoryRepository->save($category);
    }

    /**
     * @throws ValidationCategoryException
     */
    public function updateCategory(UpdateCategoryRequest $request): void
    {
        UpdateCategoryRequest::validating($request, $this->categoryRepository);

        $category = $this->categoryRepository->findByCategoryId($request->category_id, $request->id_user);
        $category->name_category = $request->name_category;
        $category->description = $request->description;

        $this->categoryRepository->updating($category);
    }

    public function allCategory(int $id_user, bool $paginate): Collection|LengthAwarePaginator
    {
        return $this->categoryRepository->findAll($id_user, $paginate);
    }

    public function getCategory(string $category_id, string $id_user): ?Category
    {
        return $this->categoryRepository->findByCategoryId($category_id, $id_user);
    }

    public function deleteCategory(DeleteCategoryRequest $request, string $categoryId, int $id_user): void
    {
        $request::validating($request, app()->make(ItemsRepository::class), $this->categoryRepository);
        $this->categoryRepository->deleteById($categoryId, $id_user);
    }
}
