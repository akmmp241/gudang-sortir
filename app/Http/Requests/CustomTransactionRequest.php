<?php

namespace App\Http\Requests;

use App\Repositories\Items\ItemsRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $name_item
 * @property ?string $item
 * @property ?string $field
 * @property ?string $type
 * @property ?string $order
 * @property ?string $search
 * @property int $id_user
 */
class CustomTransactionRequest extends FormRequest
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

    public static function validating(self $request, ItemsRepository $itemsRepository): self
    {
        $items = $itemsRepository->allItems($request->id_user);
        $temp = array();
        if ($items->all() == null) {
            $temp[] = '';
        } else {
            foreach ($items->all() as $item) {
                $temp[] = $item->item_id;
            }
        }
        $request->name_item = $temp;

        if ($request->has('type') && ($request->type != '' && $request->type != "bm" && $request->type != "bk")) {
            $request->type = null;
        }

        if ($request->has('item') && ($request->item != '' && !in_array($request->item, $request->name_item))) {
            $request->item = null;
        }

        if ($request->has('order') &&  ($request->order != "asc" && $request->order != "desc")) {
            $request->order = null;
        }

        if ($request->has('field') && ($request->field != "t.id" && $request->field != "t.transaction_date")) {
            $request->field = null;
        }

        return $request;
    }
}
