<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Repository\SessionRepository;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Akmalmp\GudangSortir\Service\SessionService;

class DashboardController
{
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);

        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }


    public function dashboard(): void
    {
        $user = $this->sessionService->current();
        View::render('Dashboard/dashboard', [
            'user' => [
                'name' => $user->getNama(),
                'email' => $user->getEmail()
            ]
        ]);
    }

    public function kategori(): void
    {
        View::render('Dashboard/tambah-kategori', []);
    }
}