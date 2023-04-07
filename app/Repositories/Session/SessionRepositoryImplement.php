<?php

namespace App\Repositories\Session;

use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Session;

class SessionRepositoryImplement extends Eloquent implements SessionRepository
{
    public function __construct()
    {
    }

    public function save(Session $session)
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
