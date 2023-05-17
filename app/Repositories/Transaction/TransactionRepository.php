<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use LaravelEasyRepository\Repository;

interface TransactionRepository extends Repository
{
    public function save(Transaction $transaction): void;
    public function getByTransactionId(string $transactionId, int $id_user): ?Transaction;

    public function getMaxCounter(int $id_user): ?string;

    public function deleteById(string $transactionId, int $id_user): void;
}
