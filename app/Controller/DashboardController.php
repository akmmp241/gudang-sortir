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

    public function kategori(): void
    {
        $data = $this->kategoriService->getAllDataKategori();
        if ($data == null) {
            View::render('Dashboard/tambah-kategori', []);
            exit();
        }
        View::render('Dashboard/tambah-kategori', [
            'kategori' => $data
        ]);
    }

    public function postKategori(): void
    {
        $request = new TambahKategoriRequest();
        $request->setIdKategori(htmlspecialchars(trim($_POST['id-kategori'])));
        $request->setNamaKategori(htmlspecialchars(trim($_POST['nama-kategori'])));
        $request->setDeskripsi(htmlspecialchars(trim($_POST['deskripsi'])));

        try {
            $this->kategoriService->tambahKategori($request);
            $_POST['id-kategori'] = '';
            $_POST['nama-kategori'] = '';
            $_POST['deskripsi'] = '';
            View::redirect('/dashboard/kategori');
        } catch (Exception $exception) {
            $data = $this->kategoriService->getAllDataKategori();
            View::render('Dashboard/tambah-kategori', [
                'kategori' => $data,
                'error' => $exception->getMessage()
            ]);
        }
    }
}