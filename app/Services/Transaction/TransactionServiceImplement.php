<?php

namespace App\Services\Transaction;

use App\Exceptions\ValidationTransactionException;
use App\Http\Requests\CustomTransactionRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Repositories\Items\ItemsRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\TransactionDetail\TransactionDetailRepository;
use App\Repositories\TransactionType\TransactionTypeRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;

class TransactionServiceImplement extends Service implements TransactionService
{
    protected TransactionDetailRepository $transactionDetailRepository;
    protected TransactionRepository $transactionRepository;
    protected TransactionTypeRepository $transactionTypeRepository;
    protected ItemsRepository $itemsRepository;

    /**
     * @param TransactionDetailRepository $transactionDetailRepository
     * @param TransactionRepository $transactionRepository
     * @param TransactionTypeRepository $transactionTypeRepository
     * @param ItemsRepository $itemsRepository
     */
    public function __construct(
        TransactionDetailRepository $transactionDetailRepository,
        TransactionRepository       $transactionRepository,
        TransactionTypeRepository   $transactionTypeRepository,
        ItemsRepository             $itemsRepository
    )
    {
        $this->transactionDetailRepository = $transactionDetailRepository;
        $this->transactionRepository = $transactionRepository;
        $this->transactionTypeRepository = $transactionTypeRepository;
        $this->itemsRepository = $itemsRepository;
    }

    /**
     * @throws ValidationTransactionException
     */
    public function transaction(TransactionRequest $request, string $type): void
    {
        $request::validating($request);
        try {
            DB::beginTransaction();

            if ($type == "masuk") {
                $transactionType = $this->transactionTypeRepository->getTransactionCode('BM');
            } else {
                $request::checkIfOutOfStock($request, $this->itemsRepository);
                $transactionType = $this->transactionTypeRepository->getTransactionCode('BK');
            }

            $transaction = new Transaction();
            $transaction->id_user = $request->userId;
            $transaction->transaction_code = $transactionType->transaction_code;
            $transaction->transaction_id = $request->transactionId;
            $transaction->counter = explode('-', $request->transactionId)[1];
            $transaction->transaction_date = $request->date;
            $transaction->description = $request->description;
            $this->transactionRepository->save($transaction);

            $item = $this->itemsRepository->getItemsByIdItems($request->itemId, $request->userId);
            $transaction = $this->transactionRepository->getByTransactionId($request->transactionId, $request->userId);

            $detail = new TransactionDetail();
            $detail->transaction_id = $transaction->id;
            $detail->item_id = $item->id;
            $detail->id_user = $request->userId;
            $detail->quantity = $request->quantity;
            $detail->description = $request->description;
            $this->transactionDetailRepository->save($detail);

            if ($type == "masuk") {
                $item->quantity = $item->quantity + $detail->quantity;
            } else {
                $item->quantity = $item->quantity - $detail->quantity;
            }

            $this->itemsRepository->updating($item);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function getAllTransaction(?CustomTransactionRequest $request, string $id_user, bool $paginate): Collection|LengthAwarePaginator
    {
        if ($request != null) {
            $requestAfterValidation = $request::validating($request, $this->itemsRepository);

            if ($request->has('order') || $request->has('field') || $requestAfterValidation->type != null || $request->has('item')) {
                return $this->transactionDetailRepository->getCustomData(
                    $requestAfterValidation->field,
                    $requestAfterValidation->type,
                    $requestAfterValidation->item,
                    $requestAfterValidation->order,
                    $request->id_user,
                    $paginate
                );
            }

            if ($request->search != null) {
                return $this->transactionDetailRepository->getBySearch($request->search, $id_user, $paginate);
            }
        }

        return $this->transactionDetailRepository->getAll($id_user, $paginate);
    }

    public function getCounter(string $id_user): ?string
    {
        $counter = $this->transactionRepository->getMaxCounter($id_user);

        return sprintf("%06s", $counter + 1);
    }
}
