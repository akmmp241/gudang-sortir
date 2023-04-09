<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationUserException;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

//    public static function validating(self $request, UserRepository $userRepository)
//    {
//        if ($request->email == null || $request->name == null ||
//            trim($request->email) == "" || trim($request->name) == "") {
//            throw ValidationUserException::blank();
//        }
//
//        if (!preg_match("/^[A-z\s]+$/", $request->name)) {
//            throw ValidationUserException::nameNotValid();
//        }
//
//        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $request->email)) {
//            throw ValidationUserException::emailNotValid();
//        }
//
//        $user = $userRepository->findByEmail($request->email);
//        if ($user != null) {
//            throw ValidationUserException::duplicateEmail();
//        }
//    }

    public function validated(UserRepository $key = null, $default = null, )
    {
        if ($this->email == null || $this->name == null ||
            trim($this->email) == "" || trim($this->name) == "") {
            throw ValidationUserException::blank();
        }

        if (!preg_match("/^[A-z\s]+$/", $this->name)) {
            throw ValidationUserException::nameNotValid();
        }

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $this->email)) {
            throw ValidationUserException::emailNotValid();
        }

        $user = $key->findByEmail($this->email);
        if ($user != null) {
            throw ValidationUserException::duplicateEmail();
        }
    }


}
