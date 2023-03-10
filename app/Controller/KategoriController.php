<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Model\KategoriUpdateRequest;
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
        $kategori = $this->kategoriService->getAllDataKategori();
        View::render('Dashboard/Kategori/kategori', [
            'kategori' => $kategori
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
            View::render('Dashboard/Kategori/kategori', [
                'kategori' => $data,
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function ubahKategori(string $id): void
    {
        $kategori = $this->kategoriService->findKategoriById($id);
        View::render('Dashboard/Kategori/ubah-kategori', [
            'id_kategori' => $kategori->getIdKategori(),
            'nama_kategori' => $kategori->getNamaKategori(),
            'deskripsi' => $kategori->getDeskripsi()
        ]);
    }

    public function postUbahKategori(string $id): void
    {
        $kategori = $this->kategoriService->findKategoriById($id);

        $request = new KategoriUpdateRequest();
        $request->setIdKategori($kategori->getIdKategori());
        $request->setNamaKategori(htmlspecialchars(trim($_POST['nama-kategori'] ?? '')));
        $request->setDeskripsi(htmlspecialchars(trim($_POST['deskripsi'] ?? '')));

        try {
            $this->kategoriService->ubahKategori($request);
            View::redirect('/dashboard/kategori');
        } catch (Exception $exception) {
            $kategori = $this->kategoriService->findKategoriById($id);
            View::render('Dashboard/Kategori/ubah-kategori', [
                'id_kategori' => $kategori->getIdKategori(),
                'nama_kategori' => $kategori->getNamaKategori(),
                'deskripsi' => $kategori->getDeskripsi(),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function hapusKategori(string $id): void
    {
        try {
            $this->kategoriService->deleteKategori($id);
            View::redirect('/dashboard/kategori');
        } catch (Exception $exception) {
            $data = $this->kategoriService->getAllDataKategori();
            View::render('Dashboard/Kategori/kategori', [
                'kategori' => $data,
                'error' => $exception->getMessage()
            ]);
        }
    }
}