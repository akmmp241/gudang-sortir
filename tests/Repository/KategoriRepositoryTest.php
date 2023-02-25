<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Kategori;
use PHPUnit\Framework\TestCase;

class KategoriRepositoryTest extends TestCase
{
    private KategoriRepository $kategoriRepository;

    protected function setUp(): void
    {
        $this->kategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMR");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $result1 = $this->kategoriRepository->findById("KMR");
        $result2 = $this->kategoriRepository->findByNamaKategori("Kamera");
        self::assertEquals($kategori->getIdKategori(), $result2->getIdKategori());
        self::assertEquals($kategori->getNamaKategori(), $result2->getNamaKategori());
        self::assertEquals($kategori->getDeskripsi(), $result2->getDeskripsi());
        self::assertEquals($kategori->getIdKategori(), $result1->getIdKategori());
        self::assertEquals($kategori->getNamaKategori(), $result1->getNamaKategori());
        self::assertEquals($kategori->getDeskripsi(), $result1->getDeskripsi());
    }

    public function testFindAll()
    {
        $kategori1 = new Kategori();
        $kategori1->setIdKategori("KMR");
        $kategori1->setNamaKategori("Kamera");
        $kategori1->setDeskripsi('');
        $this->kategoriRepository->save($kategori1);

        $kategori2 = new Kategori();
        $kategori2->setIdKategori("LNS");
        $kategori2->setNamaKategori("Lensa");
        $kategori2->setDeskripsi('');
        $this->kategoriRepository->save($kategori2);

        $result = $this->kategoriRepository->findAll();
        self::assertNotNull($result);
    }

    public function testDeleteByIdSuccess()
    {
        $kategori = new Kategori();
        $kategori->setIdKategori("KMR");
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $this->kategoriRepository->deleteById("KMR");
        $result1 = $this->kategoriRepository->findById("KMR");
        $result2 = $this->kategoriRepository->findByNamaKategori("Kamera");
        self::assertNull($result2);
    }
}
