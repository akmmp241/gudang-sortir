<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationCategoryException;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $name_category
 * @property $description
 * @property $category_id
 * @property $id_user
 */
class UpdateCategoryRequest extends FormRequest
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
     * @throws ValidationCategoryException
     */
    public static function validating(self $request, CategoryRepository $categoryRepository): void
    {
        if ($request->category_id == null || $request->name_category == null ||
            trim($request->category_id) == "" || trim($request->name_category) == "") {
            throw ValidationCategoryException::blank();
        }

        if (preg_match('/[a-z0-9`!@#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->category_id)) {
            throw ValidationCategoryException::idNotValid();
        }

        if (preg_match('/[`!@#$%^&*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $request->name_category)) {
            throw ValidationCategoryException::nameNotValid();
        }

        if (preg_match('/[`!@#$%^&*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $request->description)) {
            throw ValidationCategoryException::descriptionNotValid();
        }
    }
}
