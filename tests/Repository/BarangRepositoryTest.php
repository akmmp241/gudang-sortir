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
        $this->barangRepository = new BarangRepository(Database::getConnection());
        $this->barangRepository->deleteAll();
        $this->kategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriRepository->deleteAll();
    }


    public function testLastInsertId()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMRA");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $barang = new Barang();
        $barang->setId("00001");
        $barang->setNamaBarang("Kamera Sony A7s");
        $barang->setDeskripsi("");
        $barang->setIdKategori("KMRA");
        $barang->setIdBarang($barang->getIdKategori() . "-" . $barang->getId());
        $this->barangRepository->save($barang);
        $result = $this->barangRepository->findById("KMRA-00001");
        print_r($result);
        self::assertNotNull($result);
    }

}
