<?php

namespace App\Repositories\TransactionDetail;

use App\Models\TransactionDetail;
use Illuminate\Support\Collection;
use LaravelEasyRepository\Repository;

interface TransactionDetailRepository extends Repository
{
    public function save(TransactionDetail $transactionDetail): void;

    public function getById(int $transaction_id, int $id_user): ?TransactionDetail;

    public function getByItemId(int $item_id, int $id_user): ?TransactionDetail;

    public function getAll(int $id_user): ?Collection;

    public function getCustomData(?string $field, ?string $type, ?string $item, ?string $order, int $id_user): ?Collection;

    public function getBySearch(string $keyword, int $id_user): ?Collection;

    public function deleteByItemId(int $item_id, int $id_user): void;
}
