<?php

namespace App\Repositories\User;

use App\Models\User;
use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    public function save(User $user);

    public function updating(User $user);

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function auth(array $dataUser): bool;
}
