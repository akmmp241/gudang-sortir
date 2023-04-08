<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationUserException;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
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
    public static function validating(self $request, UserRepository $userRepository): void
    {
        if ($request->oldPassword == null || $request->newPassword == null ||
            trim($request->oldPassword) == "" || trim($request->newPassword) == "") {
            throw ValidationUserException::blank();
        }

        if (strlen($request->oldPasswor) < 8 || strlen($request->newPassword) < 8) {
            throw ValidationUserException::minimumPassword();
        }

        $user = $userRepository->findById($request->id);
        if ($user == null) {
            throw ValidationUserException::userNotFound();
        }

        if (Hash::check($request->oldPassword, $user->password)) {
            throw ValidationUserException::custom('password lama salah');
        }

        if (Hash::check($request->newPassword, $user->password)) {
            throw ValidationUserException::custom('password tidak boleh sama');
        }
    }
}
