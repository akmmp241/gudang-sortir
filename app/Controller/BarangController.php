<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Model\BarangUpdateRequest;
use Akmalmp\GudangSortir\Model\TambahBarangRequest;
use Akmalmp\GudangSortir\Repository\BarangRepository;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use Akmalmp\GudangSortir\Service\BarangService;
use Akmalmp\GudangSortir\Service\KategoriService;
use Exception;

class BarangController
{
    private KategoriService $kategoriService;
    private BarangService $barangService;

    public function __construct()
    {
        $KategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriService = new KategoriService($KategoriRepository);

        $barangRepository = new BarangRepository(Database::getConnection());
        $this->barangService = new BarangService($barangRepository);
    }

    public function barang(): void
    {
        $data = $this->kategoriService->getAllDataKategori();
        $id_barang = $this->barangService->idGenerate();
        $barang = $this->barangService->getAllDataBarang($_GET['sort'] ?? null);
        View::render('Dashboard/Barang/barang', [
            'kategori' => $data,
            'id' => $id_barang,
            'barang' => $barang
        ]);
    }

    public function postBarang(): void
    {
        $request = new TambahBarangRequest();
        $request->setId(htmlspecialchars(trim($_POST['id-barang'] ?? '')));
        $request->setNamaBarang(htmlspecialchars(trim($_POST['nama-barang'] ?? '')));
        $request->setIdKategori($_POST['id-kategori'] ?? '');
        $request->setDeskripsi(htmlspecialchars(trim($_POST['deskripsi'] ?? '')));
        try {
            $this->barangService->tambahBarang($request);
            View::redirect('/dashboard/barang');
        } catch (Exception $exception) {
            $data = $this->kategoriService->getAllDataKategori();
            $id_barang = $this->barangService->idGenerate();
            $barang = $this->barangService->getAllDataBarang($_GET['sort'] ?? null);
            View::render('Dashboard/Barang/barang', [
                'kategori' => $data,
                'id' => $id_barang,
                'barang' => $barang,
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function ubahBarang(string $id): void
    {
        $barang = $this->barangService->findBarangByIdBarang($id);
        View::render('Dashboard/Barang/ubah-barang', [
            'id_barang' => $barang->getIdBarang(),
            'nama_barang' => $barang->getNamaBarang(),
            'deskripsi' => $barang->getDeskripsi()
        ]);
    }

    public function postUbahBarang(string $id): void
    {
        $barang = $this->barangService->findBarangByIdBarang($id);

        $request = new BarangUpdateRequest();
        $request->setIdBarang($barang->getIdBarang());
        $request->setNamaBarang($_POST['nama-barang']);
        $request->setDeskripsi($_POST['deskripsi']);

        try {
            $this->barangService->ubahBarang($request);
            View::redirect('/dashboard/barang');
        } catch (Exception $exception) {
            $barang = $this->barangService->findBarangByIdBarang($id);
            View::render('Dashboard/Barang/ubah-barang', [
                'id_barang' => $barang->getIdBarang(),
                'nama_barang' => $barang->getNamaBarang(),
                'deskripsi' => $barang->getDeskripsi(),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function hapusBarang(string $id): void
    {
        try {
            $this->barangService->deleteBarang($id);
            View::redirect('/dashboard/barang');
        } catch (Exception $exception) {
            $data = $this->kategoriService->getAllDataKategori();
            $id_barang = $this->barangService->idGenerate();
            $barang = $this->barangService->getAllDataBarang($_GET['sort'] ?? null);
            View::render('Dashboard/Barang/barang', [
                'kategori' => $data,
                'id' => $id_barang,
                'barang' => $barang,
                'error' => $exception->getMessage()
            ]);
        }
    }
}