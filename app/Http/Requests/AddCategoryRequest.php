<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationCategoryException;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $category_id
 * @property $name_category
 * @property $description
 * @property $id_user
 */
class AddCategoryRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
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

        if (strlen($request->category_id) > 10) {
            throw ValidationCategoryException::idMinimum();
        }

        $category = $categoryRepository->findByCategoryId($request->category_id, $request->id_user);
        if ($category != null) {
            throw ValidationCategoryException::duplicate();
        }

        $category = $categoryRepository->findByName($request->name_category, $request->id_user);
        if ($category != null) {
            throw ValidationCategoryException::duplicate();
        }
    }
}
