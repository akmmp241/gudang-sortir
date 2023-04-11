<?php

namespace App\Http\Requests;

use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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

    public static function validating(self $request, ItemsRepository $itemsRepository): void
    {
        $path = explode('/', $request->path());
        $categoryId = end($path);
        $item = $itemsRepository->getItemsByIdCategory($categoryId, $request->id_user);
    }
}
