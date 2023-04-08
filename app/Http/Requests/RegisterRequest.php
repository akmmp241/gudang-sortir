<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationUserException;
use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @throws ValidationUserException
     */
    public static function validating(self $request, UserRepository $userRepository){
        if ($request->email == null || $request->name == null || $request->password == null ||
            $request->confirm == null || trim($request->email) == "" ||
            trim($request->name) == "" || trim($request->password) == "" ||
            trim($request->confirm) == "") {
            throw ValidationUserException::blank();
        }

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $request->email)) {
            throw ValidationUserException::emailNotValid();
        }

        $user = $userRepository->findByEmail($request->email);
        if ($user != null) {
            throw ValidationUserException::duplicateEmail();
        }

        if (!preg_match("/^[A-z\s]+$/", $request->name)) {
            throw ValidationUserException::nameNotValid();
        }

        if (strlen($request->password) < 8) {
            throw ValidationUserException::minimumPassword();
        }

        if ($request->confirm != $request->password) {
            throw ValidationUserException::confirmNotValid();
        }
    }
}
