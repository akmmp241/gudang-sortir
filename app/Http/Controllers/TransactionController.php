<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomTransactionRequest;
use App\Http\Requests\TransactionRequest;
use App\Services\Items\ItemsService;
use App\Services\Session\SessionService;
use App\Services\Transaction\TransactionService;
use DateTime;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    private ItemsService $itemsService;
    private static SessionService $sessionService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->transactionService = app()->make(TransactionService::class);
        $this->itemsService = app()->make(ItemsService::class);
        self::$sessionService = app()->make(SessionService::class);
    }

    private static function ID_USER_IN_SESSION(): ?int
    {
        return self::$sessionService->current()->id;
    }

    public function transaction(CustomTransactionRequest $request): View
    {
        $request->id_user = self::ID_USER_IN_SESSION();
        $items = $this->itemsService->getAll(null, self::ID_USER_IN_SESSION());

        $transactions = $this->transactionService->getAllTransaction($request, self::ID_USER_IN_SESSION());

        if ($request->has('search') && trim($request->search) != null) {
            $transactions = $this->transactionService->getAllTransaction($request, self::ID_USER_IN_SESSION());
        }

        if ($request->has('order') || $request->has('field') || $request->has('type') || $request->has('filter')) {
            $transactions = $this->transactionService->getAllTransaction($request, self::ID_USER_IN_SESSION());
        }

        return view('Dashboard.Transaction.transaction', [
            'transactions' => $transactions,
            'items' => $items
        ]);
    }

    public function transactionItem(TransactionRequest $request): View
    {
        $date = new DateTime;
        $items = $this->itemsService->getAll(null, self::ID_USER_IN_SESSION());
        $parseUrl = explode('/', $request->path());
        $type = end($parseUrl);

        if ($type == "masuk") {
            $transactionId = "BM-" . $this->transactionService->getCounter(self::ID_USER_IN_SESSION());
        } else {
            $transactionId = "BK-" . $this->transactionService->getCounter(self::ID_USER_IN_SESSION());
        }

        return view("Dashboard.transaction.form", [
            'transactionId' => $transactionId,
            'date' => $date->format('Y-m-d H:i'),
            'items' => $items,
            'type' => $type
        ]);
    }

    public function postTransactionItem(TransactionRequest $request): RedirectResponse
    {
        $request->userId = self::ID_USER_IN_SESSION();
        $parseUrl = explode('/', $request->path());
        $type = end($parseUrl);
        try {
            $this->transactionService->transaction($request, $type);
            if ($type == "masuk") {
                return redirect('/dashboard/transaction')->with(['message' => 'berhasil menambah stok']);
            }
            return redirect('/dashboard/transaction')->with(['message' => 'berhasil mengurangi stok']);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
