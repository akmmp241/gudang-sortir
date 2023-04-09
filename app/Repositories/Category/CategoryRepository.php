<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository
{
    public function save(Category $category): void;

    public function updating(Category $category): void;

    public function findAll(int $id_user): ?Collection;

    public function findById(int $id): ?Category;

    public function findByCategoryId(string $categoryId, int $id_user): ?Category;

    public function findByName(string $name, int $user): ?Category;

    public function deleteById(int $id, int $id_user): void;
}
