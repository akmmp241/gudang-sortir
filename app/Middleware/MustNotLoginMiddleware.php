<?php

namespace Akmalmp\GudangSortir\Middleware;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Repository\SessionRepository;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Akmalmp\GudangSortir\Service\SessionService;

class MustNotLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }


    public function before(): void
    {
        $user = $this->sessionService->current();
        if ($user != null) {
            View::redirect('/dashboard');
        }
    }

}