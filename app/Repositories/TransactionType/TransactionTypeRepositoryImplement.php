<?php

namespace App\Repositories\TransactionType;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TransactionType;

class TransactionTypeRepositoryImplement extends Eloquent implements TransactionTypeRepository
{
    public function getTransactionCode(string $code): ?TransactionType
    {
        return TransactionType::where('transaction_code', $code)->first();
    }
}
