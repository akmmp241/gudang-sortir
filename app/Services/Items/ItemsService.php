<?php

namespace App\Services\Items;

use App\Http\Requests\AddItemsRequest;
use App\Http\Requests\CustomItemRequest;
use App\Http\Requests\DeleteItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Models\Items;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelEasyRepository\BaseService;

interface ItemsService extends BaseService
{
    public function addItems(AddItemsRequest $request): void;

    public function updateItems(UpdateItemsRequest $request): void;

    public function getAll(?CustomItemRequest $request, int $id_user, bool $paginate): Collection|LengthAwarePaginator;

    public function getItemById(string $categoryId, int $id_user): ?Items;

    public function deleteItem(DeleteItemsRequest $request, string $item_id, int $id_user): void;

    public function getCounter(int $id_user): string;
}
