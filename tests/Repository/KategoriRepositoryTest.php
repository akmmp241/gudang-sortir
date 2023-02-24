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
        $kategori->setIdKategori(6);
        $kategori->setNamaKategori("Kamera");
        $kategori->setDeskripsi('');
        $this->kategoriRepository->save($kategori);

        $result1 = $this->kategoriRepository->findById(6);
        $result2 = $this->kategoriRepository->findByNamaKategori("Kamera");
        self::assertEquals($kategori->getIdKategori(), $result1->getIdKategori());
        self::assertEquals($kategori->getNamaKategori(), $result1->getNamaKategori());
        self::assertEquals($kategori->getDeskripsi(), $result1->getDeskripsi());
        self::assertEquals($kategori->getIdKategori(), $result2->getIdKategori());
        self::assertEquals($kategori->getNamaKategori(), $result2->getNamaKategori());
        self::assertEquals($kategori->getDeskripsi(), $result2->getDeskripsi());
    }


}
