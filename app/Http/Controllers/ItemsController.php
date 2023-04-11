<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationItemsException;
use App\Http\Requests\AddItemsRequest;
use App\Http\Requests\DeleteItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Models\User;
use App\Repositories\Session\SessionRepository;
use App\Services\Items\ItemsService;
use App\Services\Session\SessionService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemsController extends Controller
{
    private static SessionService $sessionService;
    private ItemsService $itemsService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        self::$sessionService = app()->make(SessionRepository::class);
        $this->itemsService = app()->make(ItemsService::class);
    }


    private static function userInSession(): ?User
    {
        return self::$sessionService->current();
    }

    public function item(): View
    {
        $item = $this->itemsService->getAll(self::userInSession()->id);
        return view('Dashboard.Item.item', [
            'item' => $item
        ]);
    }

    public function postItem(AddItemsRequest $request): RedirectResponse
    {
        $request->id_user = self::userInSession()->id;
        try {
            $this->itemsService->addItems($request);
            return redirect()->back()->with(['message' => 'berhasil menambahkan data']);
        } catch (ValidationItemsException $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function updateItem(string $categoryId): View
    {
        $item = $this->itemsService->getItemById($categoryId, self::userInSession()->id);
        return view('Dashboard.Item.update-item', [
            'item' => $item
        ]);
    }

    public function postUpdateItem(UpdateItemsRequest $request, string $categoryId): RedirectResponse
    {
        try {
            $this->itemsService->updateItems($request);
            return redirect('/dashboard/item')->with(['message' => 'berhasil mengubah barang']);
        } catch (ValidationItemsException $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function deleteItem(DeleteItemsRequest $request, string $categoryId): RedirectResponse
    {
        try {
            $this->itemsService->deleteItem($request, $categoryId, self::userInSession()->id);
            return redirect()->back()->with(['message' => 'berhasil menghapus barang']);
        } catch (ValidationItemsException $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
