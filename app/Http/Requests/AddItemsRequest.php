<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationItemsException;
use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $id_user
 * @property $counter
 * @property $name_item
 * @property $category_id
 * @property $description
 */
class AddItemsRequest extends FormRequest
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
        if ($request->name_item == null || trim($request->name_item) == "") {
            throw ValidationItemsException::blank();
        }

        if (preg_match('/[`!@#$%^&*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $request->name_item)) {
            throw ValidationItemsException::nameNotValid();
        }

        if (preg_match('/[`!@#$%^&*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $request->description)) {
            throw ValidationItemsException::descriptionNotValid();
        }

        if ($request->category_id == null || trim($request->category_id == "" || $request->category_id == "kosong")) {
            throw ValidationItemsException::categoryNotValid();
        }

        $item = $itemsRepository->getItemsByIdItems($request->counter, $request->id_user, false);
        if ($item !== null) {
            throw ValidationItemsException::duplicate();
        }

        $item = $itemsRepository->getItemsByName($request->name_item, $request->id_user, false);
        if ($item !== null) {
            throw ValidationItemsException::duplicate();
        }
    }
}
