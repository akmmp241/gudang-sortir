<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationTransactionException;
use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $userId
 * @property $transactionId
 * @property $date
 * @property $itemId
 * @property $quantity
 * @property $description
 */
class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * @throws ValidationTransactionException
     */
    public static function validating(self $request): void
    {
        if ($request->date == null || trim($request->date) == "") {
            throw ValidationTransactionException::blank();
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->description)) {
            throw ValidationTransactionException::descriptionNotValid();
        }

        if (trim($request->itemId) == "null" || trim($request->itemId) == null) {
            throw ValidationTransactionException::itemNotValid();
        }

        if ((int)$request->quantity < 1) {
            throw ValidationTransactionException::minimumTransaction();
        }
    }

    /**
     * @throws ValidationTransactionException
     */
    public static function checkIfOutOfStock(self $request, ItemsRepository $itemsRepository): void
    {
        $item = $itemsRepository->getItemsByIdItems($request->itemId, $request->userId);

        if ($request->quantity > $item->quantity) {
            throw ValidationTransactionException::outOfStock();
        }
    }
}
