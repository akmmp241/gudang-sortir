<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Barang;
use Akmalmp\GudangSortir\Domain\DetailTransaksi;
use Akmalmp\GudangSortir\Domain\Kategori;
use Akmalmp\GudangSortir\Domain\Transaksi;
use DateTime;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class DetailTransaksiRepositoryTest extends TestCase
{
    private DetailTransaksiRepository $detailTransaksiRepository;
    private TransaksiRepository $transaksiRepository;
    private BarangRepository $barangRepository;
    private KategoriRepository $kategoriRepository;

    protected function setUp(): void
    {
        $this->detailTransaksiRepository = new DetailTransaksiRepository(Database::getConnection());
        $this->detailTransaksiRepository->deleteAll();
        $this->barangRepository = new BarangRepository(Database::getConnection());
        $this->barangRepository->deleteAll();
        $this->kategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriRepository->deleteAll();
        $this->transaksiRepository = new TransaksiRepository(Database::getConnection());
        $this->transaksiRepository->deleteAll();
    }

    public function testSaveSuccessBM()
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

        $transaksi = new Transaksi();
        $transaksi->setId(19);
        $transaksi->setTransaksiKode('BM');
        $transaksi->setIdTransaksi($transaksi->getTransaksiKode() . "-" . sprintf('%06s', $transaksi->getId()));
        $transaksi->setTanggalTransaksi(new DateTime());
        $transaksi->setDeskripsi('');
        $this->transaksiRepository->save($transaksi);


        $detailTransaksi = new DetailTransaksi();
        $detailTransaksi->setIdTransaksi($transaksi->getIdTransaksi());
        $detailTransaksi->setIdBarang($barang->getIdBarang());
        $detailTransaksi->setKuantitas(5);
        $detailTransaksi->setDeskripsi('');
        $this->detailTransaksiRepository->save($detailTransaksi);

        $barang = $this->barangRepository->findByIdBarang($barang->getIdBarang());

        $barang->setKuantitas($barang->getKuantitas() + $detailTransaksi->getKuantitas());

        $this->barangRepository->update($barang);

        $result = $this->detailTransaksiRepository->findById($detailTransaksi->getIdTransaksi());
        $resultB = $this->barangRepository->findByIdBarang($detailTransaksi->getIdBarang());

        self::assertEquals($detailTransaksi->getIdTransaksi(), $result->getIdTransaksi());
        self::assertEquals($detailTransaksi->getIdBarang(), $result->getIdBarang());
        self::assertEquals($detailTransaksi->getKuantitas(), $resultB->getKuantitas());
    }

}
