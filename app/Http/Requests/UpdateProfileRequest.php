<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationUserException;
use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $id
 * @property $name
 * @property $email
 */
class UpdateProfileRequest extends FormRequest
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
     * @throws ValidationUserException
     */
    public static function validating(self $request): void
    {
        if ($request->email == null || $request->name == null ||
            trim($request->email) == "" || trim($request->name) == "") {
            throw ValidationUserException::blank();
        }

        if (!preg_match("/^[A-z\s]+$/", $request->name)) {
            throw ValidationUserException::nameNotValid();
        }

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $request->email)) {
            throw ValidationUserException::emailNotValid();
        }
    }
}
