<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomTransactionRequest;
use App\Services\Session\SessionService;
use App\Services\Transaction\TransactionService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private SessionService $sessionService;
    private TransactionService $transactionService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->sessionService = app()->make(SessionService::class);
        $this->transactionService = app()->make(TransactionService::class);
    }

    public function dashboard(): View
    {
        $user = $this->sessionService->current();

        $request = new CustomTransactionRequest();
        $request->id_user = $user->id;
        $request->type = 'bm';
        $transactionBm = $this->transactionService->getAllTransaction($request, $user->id, false);
//        dd($transactionBm->all());

        $request->type = 'bk';
        $transactionBk = $this->transactionService->getAllTransaction($request, $user->id, false);

        return view('Dashboard.dashboard', [
            'title' => 'dashboard',
            'user' => $user,
            'item' => [
                'in' => count($transactionBm ?? []),
                'out' => count($transactionBk ?? [])
            ],
            'last' => [
                'in' => $transactionBm->last() ?? 'kosong',
                'out' => $transactionBk->last() ?? 'kosong'
            ]
        ]);
    }
}
