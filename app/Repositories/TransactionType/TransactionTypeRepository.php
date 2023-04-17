<?php

namespace App\Repositories\TransactionType;

use App\Models\TransactionType;
use LaravelEasyRepository\Repository;

interface TransactionTypeRepository extends Repository
{
    public function getTransactionCode(string $code): ?TransactionType;
}
