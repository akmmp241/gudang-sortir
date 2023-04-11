<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationItemsException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $id_user
 * @property $item_id
 * @property $name_item
 * @property $description
 */
class UpdateItemsRequest extends FormRequest
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
    public static function validating(self $request): void
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
    }
}
