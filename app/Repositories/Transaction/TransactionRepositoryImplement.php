<?php

namespace App\Repositories\Transaction;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Transaction;

class TransactionRepositoryImplement extends Eloquent implements TransactionRepository
{
    public function save(Transaction $transaction): void
    {
        $transaction->save();
    }

    public function getByTransactionId(string $transactionId, int $id_user): ?Transaction
    {
        return Transaction::where('transaction_id', $transactionId)
            ->where('id_user', $id_user)->first();
    }

    public function getMaxCounter(int $id_user): ?string
    {
        return Transaction::where('id_user', $id_user)->max('counter');
    }

    public function deleteById(string $transactionId, int $id_user): void
    {
        Transaction::where('transaction_id', $transactionId)
            ->where('id_user', $id_user)->delete();
    }

}
