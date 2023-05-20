<?php

namespace App\Http\Requests;

use App\Repositories\Category\CategoryRepository;
use App\Services\Category\CategoryService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property ?string $field
 * @property ?string $category
 * @property ?string $order
 * @property array $categories_id
 * @property int $id_user
 */
class CustomItemRequest extends FormRequest
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

    public static function validating(self $request, CategoryRepository $categoryRepository): self
    {
        $temp = array();
        $categories = $categoryRepository->findAll($request->id_user);
        if ($categories->all() == null) {
            $temp[] = '';
        } else {
            foreach ($categories->all() as $category) {
                $temp[] = $category->name_category;
            }
        }
        $request->categories_id = $temp;

        if ($request->has('category') && ($request->category != '' && !in_array($request->category, $request->categories_id))) {
            $request->category = null;
        }

        if ($request->has('order') && ($request->order != '' && $request->order != 'asc' && $request->order != 'desc')) {
            $request->order = null;
        }

        if ($request->has('field') &&
            ($request->field != '' &&
                $request->field != 'i.id' && $request->field != 'i.name_item' && $request->field != 'i.quantity'))
        {
            $request->field = null;
        }

        return $request;
    }
}
