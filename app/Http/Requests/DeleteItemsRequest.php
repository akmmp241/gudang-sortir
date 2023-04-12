<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationItemsException;
use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $id_user
 */
class DeleteItemsRequest extends FormRequest
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
     * @throws ValidationItemsException
     */
    public static function validating(self $request, ItemsRepository $itemsRepository): void
    {
        $path = explode('/', $request->path());
        $itemsId = end($path);
        $item = $itemsRepository->getItemsByIdItems($itemsId, $request->id_user, false);
        if ($item->quantity > 0) {
            throw ValidationItemsException::categoryNotValid();
        }
    }
}
