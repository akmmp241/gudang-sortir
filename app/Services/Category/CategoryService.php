<?php

namespace App\Services\Category;

use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use LaravelEasyRepository\BaseService;

interface CategoryService extends BaseService
{
    public function addCategory(AddCategoryRequest $request): void;

    public function updateCategory(UpdateCategoryRequest $request): void;

    public function allCategory(int $id_user): ?Collection;

    public function getCategory(string $category_id, string $id_user): ?Category;

    public function deleteCategory(DeleteCategoryRequest $request, string $categoryId, int $id_user): void;
}
