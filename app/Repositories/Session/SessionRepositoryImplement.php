<?php

namespace App\Repositories\Session;

use App\Models\Session;
use LaravelEasyRepository\Implementations\Eloquent;

class SessionRepositoryImplement extends Eloquent implements SessionRepository
{
    public function __construct()
    {
    }

    public function save(Session $session): void
    {
        $session->save();
    }

    public function findByToken(string $token): ?Session
    {
        return Session::where('token', $token)->first();
    }

    public function deleteByToken(string $token): void
    {
        Session::where('token', $token)->delete();
    }


}
