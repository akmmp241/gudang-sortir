<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemsRequest;
use App\Http\Requests\CustomItemRequest;
use App\Http\Requests\DeleteItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Services\Category\CategoryService;
use App\Services\Items\ItemsService;
use App\Services\Session\SessionService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemsController extends Controller
{
    private static SessionService $sessionService;
    private ItemsService $itemsService;
    private CategoryService $categoryService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        self::$sessionService = app()->make(SessionService::class);
        $this->itemsService = app()->make(ItemsService::class);
        $this->categoryService = app()->make(CategoryService::class);
    }


    private static function ID_USER_IN_SESSION(): ?int
    {
        return self::$sessionService->current()->id;
    }

    public function item(CustomItemRequest $request): View
    {
        $request->id_user = self::ID_USER_IN_SESSION();
        $items = $this->itemsService->getAll($request, self::ID_USER_IN_SESSION());
        $categories = $this->categoryService->allCategory(self::ID_USER_IN_SESSION());
        $counter = $this->itemsService->getCounter(self::ID_USER_IN_SESSION());

        return view('Dashboard.Item.item', [
            'items' => $items,
            'categories' => $categories,
            'counter' => $counter
        ]);
    }

    public function postItem(AddItemsRequest $request): RedirectResponse
    {
        $request->id_user = self::ID_USER_IN_SESSION();

        try {
            $this->itemsService->addItems($request);
            return redirect()->back()->with(['message' => 'berhasil menambahkan data']);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function updateItem(string $categoryId): View
    {
        $item = $this->itemsService->getItemById($categoryId, self::ID_USER_IN_SESSION());

        return view('Dashboard.Item.update-item', [
            'item' => $item
        ]);
    }

    public function postUpdateItem(UpdateItemsRequest $request): RedirectResponse
    {
        $request->id_user = self::ID_USER_IN_SESSION();

        try {
            $this->itemsService->updateItems($request);
            return redirect('/dashboard/item')->with(['message' => 'berhasil mengubah barang']);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function deleteItem(DeleteItemsRequest $request, string $categoryId): RedirectResponse
    {
        $request->id_user = self::ID_USER_IN_SESSION();
        try {
            $this->itemsService->deleteItem($request, $categoryId, $request->id_user);
            return redirect()->back()->with(['message' => 'berhasil menghapus barang']);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
