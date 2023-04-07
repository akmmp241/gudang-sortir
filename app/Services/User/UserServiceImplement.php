<?php

namespace App\Services\User;

use App\Exceptions\ValidationUserException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Define your custom methods :)

    /**
     * @throws ValidationUserException
     * @throws Exception
     */
    public function register(RegisterRequest $request): void
    {
        RegisterRequest::validating($request, $this->userRepository);
        try {
            DB::beginTransaction();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $this->userRepository->save($user);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @throws ValidationUserException
     */
    public function login(LoginRequest $request): ?User
    {
        $info = $this->userRepository->auth([
            'name' => $request->name,
            'password' => $request->password
        ]);

        if (!$info) {
            throw ValidationUserException::loginFailed();
        }

        return $this->userRepository->findByEmail($request->email);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        // TODO: Implement updatePassword() method.
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        // TODO: Implement updateProfile() method.
    }
}
