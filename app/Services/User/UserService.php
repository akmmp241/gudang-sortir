<?php

namespace App\Services\User;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
    public function register(RegisterRequest $request);

    public function login(LoginRequest $request);

    public function updatePassword(UpdatePasswordRequest $request);

    public function updateProfile(UpdateProfileRequest $request);
}
