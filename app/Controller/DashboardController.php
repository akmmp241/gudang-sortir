<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Model\TambahKategoriRequest;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use Akmalmp\GudangSortir\Repository\SessionRepository;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Akmalmp\GudangSortir\Service\KategoriService;
use Akmalmp\GudangSortir\Service\SessionService;
use Exception;

class DashboardController
{
    private SessionService $sessionService;
    private KategoriService $kategoriService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $kategoriRepository = new KategoriRepository($connection);

        $this->sessionService = new SessionService($sessionRepository, $userRepository);
        $this->kategoriService = new KategoriService($kategoriRepository);
    }


    public function dashboard(): void
    {
        $user = $this->sessionService->current();
        $data = $this->kategoriService->getAllDataKategori();
        if ($data == null) {
            View::render('Dashboard/dashboard', [
                'user' => [
                    'name' => $user->getNama(),
                    'email' => $user->getEmail()
                ]
            ]);
            exit();
        }

        View::render('Dashboard/dashboard', [
            'user' => [
                'name' => $user->getNama(),
                'email' => $user->getEmail()
            ],
            'kategori' => $data
        ]);
    }
}