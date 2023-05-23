<?php

namespace App\Services\Items;

use App\Exceptions\ValidationItemsException;
use App\Http\Requests\AddItemsRequest;
use App\Http\Requests\CustomItemRequest;
use App\Http\Requests\DeleteItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Models\Items;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelEasyRepository\Service;
use App\Repositories\Items\ItemsRepository;

class ItemsServiceImplement extends Service implements ItemsService
{
    protected ItemsRepository $itemsRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(ItemsRepository $itemsRepository, CategoryRepository $categoryRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws ValidationItemsException
     */
    public function addItems(AddItemsRequest $request): void
    {
        AddItemsRequest::validating($request, $this->itemsRepository);

        $idCategory = $this->categoryRepository->findByCategoryId($request->category_id, $request->id_user);

        $item = new Items();
        $item->id_user = $request->id_user;
        $item->counter = $request->counter;
        $item->item_id = $request->category_id . '-' . $item->counter;
        $item->id_category = $idCategory->id;
        $item->name_item = $request->name_item;
        $item->description = $request->description;

        $this->itemsRepository->save($item);
    }

    /**
     * @throws ValidationItemsException
     */
    public function updateItems(UpdateItemsRequest $request): void
    {
        UpdateItemsRequest::validating($request);

        $item = $this->itemsRepository->getItemsByIdItems($request->item_id, $request->id_user);

        $item->name_item = $request->name_item;
        $item->description = $request->description;

        $this->itemsRepository->updating($item);
    }

    public function getAll(?CustomItemRequest $request, int $id_user, bool $paginate): Collection|LengthAwarePaginator
    {
        if ($request != null) {
            $customItemRequest = $request::validating($request, $this->categoryRepository);

            if ($request->has('order') || $request->has('field') || $request->has('category')) {
                return $this->itemsRepository->getCustom(
                    $customItemRequest->field,
                    $customItemRequest->category,
                    $customItemRequest->order,
                    $request->id_user,
                    $paginate
                );
            }
        }

        return $this->itemsRepository->allItems($id_user, $paginate);
    }

    public function getItemById(string $categoryId, int $id_user): ?Items
    {
        return $this->itemsRepository->getItemsByIdItems($categoryId, $id_user);
    }

    /**
     * @throws ValidationItemsException
     */
    public function deleteItem(DeleteItemsRequest $request, string $item_id, int $id_user): void
    {
        DeleteItemsRequest::validating($request, $this->itemsRepository);
        $this->itemsRepository->deleteById($item_id, $id_user);
    }

    public function getCounter(int $id_user): string
    {
        return sprintf('%05s', $this->itemsRepository->getCounter($id_user) + 1);
    }
}
