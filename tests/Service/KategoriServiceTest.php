<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Kategori;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\TambahKategoriRequest;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use PHPUnit\Framework\TestCase;

class KategoriServiceTest extends TestCase
{
    private KategoriService $kategoriService;
    protected KategoriRepository $kategoriRepository;

    protected function setUp(): void
    {
        $this->kategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriRepository->deleteAll();
        $this->kategoriService = new KategoriService($this->kategoriRepository);
    }

    public function testTambahKategoriSuccess()
    {
        $request = new TambahKategoriRequest();
        $request->setIdKategori(htmlspecialchars(trim("KMR")));
        $request->setNamaKategori(htmlspecialchars(trim("Kamera ")));
        $request->setDeskripsi(htmlspecialchars(trim('Kategori barang kamera')));

        $this->kategoriService->tambahKategori($request);

        $result1 = $this->kategoriRepository->findById($request->getIdKategori());
        $result2 = $this->kategoriRepository->findByNamaKategori($request->getNamaKategori());

        self::assertEquals($request->getIdKategori(), $result1->getIdKategori());
        self::assertEquals($request->getNamaKategori(), $result1->getNamaKategori());
        self::assertEquals($request->getDeskripsi(), $result1->getDeskripsi());
        self::assertEquals($request->getIdKategori(), $result2->getIdKategori());
        self::assertEquals($request->getNamaKategori(), $result2->getNamaKategori());
        self::assertEquals($request->getDeskripsi(), $result2->getDeskripsi());
    }

    public function testValidationError()
    {
        $this->expectException(ValidationExcepetion::class);
        $this->expectExceptionMessage("Nama kategori tidak boleh kosong");

        $request = new TambahKategoriRequest();
        $request->setIdKategori(htmlspecialchars(trim("KMR")));
        $request->setNamaKategori(htmlspecialchars(trim("")));
        $request->setDeskripsi(htmlspecialchars(trim("")));

        $this->kategoriService->tambahKategori($request);
    }

    public function testDuplicate()
    {
        $this->expectException(ValidationExcepetion::class);

        $kategori = new Kategori();
        $kategori->setIdKategori("kmr");
        $kategori->setNamaKategori("kamera");
        $kategori->setDeskripsi("");

        $this->kategoriRepository->save($kategori);

        $request = new TambahKategoriRequest();
        $request->setIdKategori(htmlspecialchars(trim("KMR")));
        $request->setNamaKategori(htmlspecialchars(trim("Kamera ")));
        $request->setDeskripsi(htmlspecialchars(trim('Kategori barang kamera')));

        $this->kategoriService->tambahKategori($request);
    }


}
