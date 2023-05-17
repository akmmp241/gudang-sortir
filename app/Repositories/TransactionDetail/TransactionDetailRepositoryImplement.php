<?php

namespace App\Repositories\TransactionDetail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TransactionDetail;

class TransactionDetailRepositoryImplement extends Eloquent implements TransactionDetailRepository
{
    public function save(TransactionDetail $transactionDetail): void
    {
        $transactionDetail->save();
    }

    public function getById(int $transaction_id, int $id_user): ?TransactionDetail
    {
        return TransactionDetail::where('transaction_id', $transaction_id)
            ->where('id_user', $id_user)->first();
    }

    public function getByItemId(int $item_id, int $id_user): ?TransactionDetail
    {
        return TransactionDetail::where('item_id', $item_id)
            ->where('id_user', $id_user)->first();
    }

    public function getAll(int $id_user): ?Collection
    {
        return TransactionDetail::where('id_user', $id_user)->get();
    }

    public function getBySearch(string $keyword, int $id_user): \Illuminate\Support\Collection
    {
        return DB::table('transaction_detail', 'd')
            ->join('transaction as t', 't.id', '=', 'd.transaction_id')
            ->join('items as i', 'i.id', '=', 'd.item_id')
            ->join('categories as c', 'c.id', '=', 'i.id_category')
            ->join('transaction_type as ty', 'ty.transaction_code', '=', 't.transaction_code')
            ->where('i.name_item', 'LIKE', '%' . $keyword . '%')
            ->orWhere('t.transaction_id', 'LIKE', '%' . $keyword . '%')
            ->orWhere('d.description', 'LIKE', '%' . $keyword . '%')
            ->orWhere('t.transaction_date', 'LIKE', '%' . $keyword . '%')
            ->orWhere('c.name_category', 'LIKE', '%' . $keyword . '%')
            ->where('d.id_user', '=', $id_user)
            ->get();
    }

    public function getCustomData(?string $field, ?string $type, ?string $item, ?string $order, int $id_user): ?\Illuminate\Support\Collection
    {
        $data = DB::table('transaction_detail', 'd')
            ->join('transaction as t', 't.id', '=', 'd.transaction_id')
            ->join('items as i', 'i.id', '=', 'd.item_id')
            ->join('categories as c', 'c.id', '=', 'i.id_category')
            ->join('transaction_type as ty', 'ty.transaction_code', '=', 't.transaction_code');

        if ($type != null && $type != '') {
            $data->where('t.transaction_code', '=', $type);
        }

        if ($item != null && $item != '') {
            $data->where('i.item_id', '=', $item);
        }

        if ($field != null && $field != '') {
            if ($order != null && $order != '') {
                $data->orderBy($field, $order);
            } else {
                $data->orderBy('t.id', $order);
            }
        } else {
            if ($order != null && $order != '') {
                $data->orderBy('t.id', $order);
            } else {
                $data->orderBy('t.id', 'asc');
            }
        }

        return $data->get();
    }

    public function deleteByItemId(int $item_id, int $id_user): void
    {
        TransactionDetail::where('item_id', $item_id)
            ->where('id_user', $id_user)->delete();
    }

}
