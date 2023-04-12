<?php

namespace App\Repositories\Session;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Repository;

interface SessionRepository extends Repository
{
    public function save(Session $session);

    public function findByToken(string $token): Session|Model|null;

    public function deleteByToken(string $token);
}
