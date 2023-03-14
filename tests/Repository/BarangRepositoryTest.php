<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Barang;
use Akmalmp\GudangSortir\Domain\Kategori;
use PHPUnit\Framework\TestCase;

class BarangRepositoryTest extends TestCase
{
    private BarangRepository $barangRepository;
    private KategoriRepository $kategoriRepository;

    protected function setUp(): void
    {
        $detailTransaksiRepository = new DetailTransaksiRepository(Database::getConnection());
        $detailTransaksiRepository->deleteAll();
        $this->barangRepository = new BarangRepository(Database::getConnection());
        $this->barangRepository->deleteAll();
        $this->kategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriRepository->deleteAll();
    }

    public function testTambahBarangSuccess()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMR");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $barang = new Barang();
        $barang->setId("00001");
        $barang->setIdKategori("KMR");
        $barang->setIdBarang($barang->getIdKategori() . "-" . $barang->getId());
        $barang->setNamaBarang("Sony");
        $barang->setDeskripsi('');
        $this->barangRepository->save($barang);

        $result = $this->barangRepository->findByIdBarang("KMR-00001");

        self::assertEquals($result->getIdBarang(), $barang->getIdBarang());
        self::assertEquals($result->getNamaBarang(), $barang->getNamaBarang());
    }

    public function testUpdateSuccess()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMR");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $barang = new Barang();
        $barang->setId("00001");
        $barang->setIdKategori("KMR");
        $barang->setIdBarang($barang->getIdKategori() . "-" . $barang->getId());
        $barang->setNamaBarang("Sony");
        $barang->setDeskripsi('');
        $this->barangRepository->save($barang);

        $update = $this->barangRepository->findByIdBarang($barang->getIdBarang());

        $update->setDeskripsi("awww");

        $this->barangRepository->update($update);

        $result = $this->barangRepository->findByIdBarang($update->getIdBarang());

        self::assertEquals($result->getIdBarang(), $update->getIdBarang());
        self::assertEquals($result->getDeskripsi(), $update->getDeskripsi());
    }

    public function testGetMaxId()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMR");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $barang = new Barang();
        $barang->setId("00001");
        $barang->setIdKategori("KMR");
        $barang->setIdBarang($barang->getIdKategori() . "-" . $barang->getId());
        $barang->setNamaBarang("Sony");
        $barang->setDeskripsi('');
        $this->barangRepository->save($barang);

        $id = $this->barangRepository->getMaxId();
        self::assertEqualsIgnoringCase('00001', $id);
    }

    public function testDeleteById()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMR");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $barang = new Barang();
        $barang->setId("00001");
        $barang->setIdKategori("KMR");
        $barang->setIdBarang($barang->getIdKategori() . "-" . $barang->getId());
        $barang->setNamaBarang("Sony");
        $barang->setDeskripsi('');
        $this->barangRepository->save($barang);

        $this->barangRepository->deleteById($barang->getIdBarang());

        $result = $this->barangRepository->findByIdBarang($barang->getIdBarang());

        self::assertNull($result);
    }


}
