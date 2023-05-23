<?php

namespace App\Repositories\Items;

use App\Models\Items;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelEasyRepository\Repository;

interface ItemsRepository extends Repository
{
    public function save(Items $items): void;

    public function updating(Items $items): void;

    public function allItems(int $id_user, bool $paginate): Collection|LengthAwarePaginator;

    public function getCustom(?string $field, ?string $category, ?string $order, int $id_user, bool $paginate): LengthAwarePaginator|Collection;

    public function getItemsByIdItems(string $items_id, int $user): ?Items;

    public function getItemsByName(string $name, int $id_user): ?Items;

    public function getItemsByIdCategory(int $id_category, int $id_user): ?Items;

    public function getCounter(int $id_user): ?string;

    public function deleteById(string $id_items, int $id_user): void;

}
