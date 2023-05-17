<?php

namespace App\Services\Transaction;

use App\Http\Requests\CustomTransactionRequest;
use App\Http\Requests\TransactionRequest;
use Illuminate\Support\Collection;
use LaravelEasyRepository\BaseService;

interface TransactionService extends BaseService
{
    public function transaction(TransactionRequest $request, string $type): void;

    public function getAllTransaction(?CustomTransactionRequest $request, string $id_user): Collection;

    public function getCounter(string $id_user): ?string;
}
