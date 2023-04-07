<?php

namespace App\Services\Session;

use App\Models\User;
use LaravelEasyRepository\BaseService;

interface SessionService extends BaseService
{
    public function creating(int $id);

    public function destroying(): void;

    public function current(): ?User;
}
