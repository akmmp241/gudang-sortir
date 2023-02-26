<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Model\TambahKategoriRequest;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use Akmalmp\GudangSortir\Service\KategoriService;
use Exception;

class KategoriController
{
    private KategoriService $kategoriService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $kategoriRepository = new KategoriRepository($connection);

        $this->kategoriService = new KategoriService($kategoriRepository);
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

    public function hapusKategori(string $id)
    {
        try {
            $this->kategoriService->deleteKategori($id);
            View::redirect('/dashboard/kategori');
        } catch (Exception $exception) {
            View::render('/dashboard/kategori', [
                'error' => $exception->getMessage()
            ]);
        }
    }
}