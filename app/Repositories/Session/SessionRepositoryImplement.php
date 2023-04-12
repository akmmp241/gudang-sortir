<?php

namespace App\Repositories\Session;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
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

    public function findByToken(string $token): Session|Model|null
    {
        return Session::with('user')->where('token', $token)->first();
    }

    public function deleteByToken(string $token): void
    {
        Session::with('user')->where('token', $token)->delete();
    }


}
