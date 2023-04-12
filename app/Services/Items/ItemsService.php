<?php

namespace App\Services\Items;

use App\Http\Requests\AddItemsRequest;
use App\Http\Requests\DeleteItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Models\Items;
use Illuminate\Database\Eloquent\Collection;
use LaravelEasyRepository\BaseService;

interface ItemsService extends BaseService
{
    public function addItems(AddItemsRequest $request): void;

    public function updateItems(UpdateItemsRequest $request): void;

    public function getAll(int $id_user): ?Collection;

    public function getItemById(string $categoryId, int $id_user, bool $relation): ?Items;

    public function deleteItem(DeleteItemsRequest $request, string $item_id, int $id_user): void;

    public function getCounter(int $id_user): string;
}
