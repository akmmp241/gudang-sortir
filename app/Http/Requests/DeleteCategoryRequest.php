<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationCategoryException;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property $id_user
 */
class DeleteCategoryRequest extends FormRequest
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
    public static function validating(self $request, ItemsRepository $itemsRepository, CategoryRepository $categoryRepository): void
    {
        $path = explode('/', $request->path());
        $categoryId = end($path);
        $category = $categoryRepository->findByCategoryId($categoryId, $request->id_user);
        $item = $itemsRepository->getItemsByIdCategory($category->id, $request->id_user);
        if ($item != null) {
            throw ValidationCategoryException::deleteFailed();
        }
    }
}
