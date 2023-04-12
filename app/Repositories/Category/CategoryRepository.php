<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository
{
    public function save(Category $category): void;

    public function updating(Category $category): void;

    public function findAll(int $id_user): ?Collection;

    public function findById(int $id): Category|Model|null;

    public function findByCategoryId(string $categoryId, int $id_user): Category|Model|null;

    public function findByName(string $name, int $user): Category|Model|null;

    public function deleteById(string $category_id, int $id_user): void;
}
