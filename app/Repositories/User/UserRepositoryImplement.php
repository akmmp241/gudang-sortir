<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    public function __construct()
    {
    }

    public function save(User $user): void
    {
        $user->save();
    }

    public function updating(User $user): void
    {
        $user->update();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function auth(array $dataUser): bool
    {
        return Auth::attempt([
            'email' => $dataUser['email'],
            'password' => $dataUser['password']
        ]);
    }
}
