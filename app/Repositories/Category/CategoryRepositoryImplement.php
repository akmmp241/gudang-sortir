<?php

namespace App\Repositories\Category;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Category;

class CategoryRepositoryImplement extends Eloquent implements CategoryRepository
{

    public function __construct()
    {
    }

    public function save(Category $category): void
    {
        $category->save();
    }

    public function updating(Category $category): void
    {
        $category->update();
    }

    public function findAll(int $id_user, bool $paginate): Collection|LengthAwarePaginator
    {
        if ($paginate) {
            return Category::where('id_user', $id_user)->paginate(8);
        }
        return Category::where('id_user', $id_user)->get();
    }

    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function findByCategoryId(string $categoryId, int $id_user): ?Category
    {
        return Category::where('category_id', $categoryId)
            ->where('id_user', $id_user)
            ->first();
    }

    public function findByName(string $name, int $user): ?Category
    {
        return Category::where('name_category', $name)
            ->where('id_user', $user)
            ->first();
    }

    public function deleteById(string $category_id, int $id_user): void
    {
        $this->findByCategoryId($category_id, $id_user)->delete();
    }


}
