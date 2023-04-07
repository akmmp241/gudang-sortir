<?php

namespace App\Repositories\Session;

use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Session;

class SessionRepositoryImplement extends Eloquent implements SessionRepository{
    public function __construct()
    {
    }

}
