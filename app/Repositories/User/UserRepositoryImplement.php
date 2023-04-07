<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    public function __construct()
    {
    }
}
