<?php

namespace App\Repositories\Items;

use App\Models\Items;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

    public function allItems(int $id_user, bool $paginate): Collection|LengthAwarePaginator
    {
        if ($paginate) {
            return Items::where('id_user', $id_user)->paginate(10);

        }
        return Items::where('id_user', $id_user)->get();
    }

    public function getCustom(?string $field, ?string $category, ?string $order, int $id_user, bool $paginate): Collection|LengthAwarePaginator
    {
        $item = DB::table('items', 'i')
            ->join('categories as c', 'c.id', '=', 'i.id_category')
            ->where('i.id_user', '=', $id_user);

        if ($category != null && $category != '') {
            $item->where('c.category_id', '=', $category);
        }

        if ($field != null && $field != '') {
            if ($order != null && $order != '') {
                $item->orderBy($field, $order);
            } else {
                $item->orderBy($field, 'asc');
            }
        } else {
            if ($order != null && $order != '') {
                $item->orderBy('i.id', $order);
            } else {
                $item->orderBy('i.id', 'asc');
            }
        }

        if ($paginate) {
            return $item->paginate(10);
        }
        return $item->get();
    }

    public function getItemsByIdItems(string $items_id, int $user): ?Items
    {
        return Items::where('item_id', $items_id)
            ->where('id_user', $user)->first();
    }

    public function getItemsByName(string $name, int $id_user): ?Items
    {
        return Items::where('name_item', $name)
            ->where('id_user', $id_user)->first();
    }

    public function getItemsByIdCategory(int $id_category, int $id_user): ?Items
    {
        return Items::where('id_category', $id_category)
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
