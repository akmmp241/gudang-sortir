<?php

namespace App\Repositories\Session;

use App\Models\Session;
use App\Models\User;
use LaravelEasyRepository\Repository;

interface SessionRepository extends Repository
{
    public function save(Session $session);

    public function findByToken(string $token): ?Session;

    public function deleteByToken(string $token);
}
