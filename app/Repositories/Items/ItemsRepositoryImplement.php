<?php

namespace App\Repositories\Items;

use App\Models\Items;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Implementations\Eloquent;

class ItemsRepositoryImplement extends Eloquent implements ItemsRepository
{
    public function save(Items $items): void
    {
        $items->save();
    }

    public function updating(Items $items): void
    {
        $items->update();
    }

    public function allItems(int $id_user): ?Collection
    {
        return Items::with(['user', 'category'])
            ->where('id_user', $id_user)->get();
    }

    public function getItemsByIdItems(string $items_id, int $user): Items|Model|null
    {
        return Items::with(['user', 'category'])
            ->where('item_id', $items_id)
            ->where('id_user', $user)->first();
    }

    public function getItemsByName(string $name, int $id_user): Items|Model|null
    {
        return Items::with(['user', 'category'])
            ->where('name_item', $name)
            ->where('id_user', $id_user)->first();
    }

    public function getItemsByIdCategory(int $id_category, int $id_user): Items|Model|null
    {
        return Items::with(['user', 'category'])
            ->where('id_category', $id_category)
            ->where('id_user', $id_user)->first();
    }

    public function getCounter(int $id_user): ?string
    {
        return Items::with(['user', 'category'])
            ->where('id_user', $id_user)
            ->max('counter');
    }

    public function deleteById(string $id_items, int $id_user): void
    {
        $this->getItemsByIdItems($id_items, $id_user)->delete();
    }

}
