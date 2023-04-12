<?php

namespace App\Repositories\Items;

use App\Models\Items;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Repository;

interface ItemsRepository extends Repository
{
    public function save(Items $items): void;

    public function updating(Items $items): void;

    public function allItems(int $id_user, bool $relation): ?Collection;

    public function getItemsByIdItems(string $items_id, int $user, bool $relation): Items|Model|null;

    public function getItemsByName(string $name, int $id_user, bool $relation): Items|Model|null;

    public function getItemsByIdCategory(int $id_category, int $id_user, bool $relation): Items|Model|null;

    public function getCounter(int $id_user): ?string;

    public function deleteById(string $id_items, int $id_user): void;

}
