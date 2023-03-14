<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Transaksi;
use DateTime;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class TransaksiRepositoryTest extends TestCase
{
    private TransaksiRepository $transaksiRepository;

    protected function setUp(): void
    {
        $this->transaksiRepository = new TransaksiRepository(Database::getConnection());
        $this->transaksiRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $transaksi = new Transaksi();
        $transaksi->setId(20);
        $transaksi->setTransaksiKode('BM');
        $transaksi->setIdTransaksi($transaksi->getTransaksiKode() . "-" . sprintf('%06s', $transaksi->getId()));
        $transaksi->setTanggalTransaksi(new DateTime());
        $transaksi->setDeskripsi('');
        $this->transaksiRepository->save($transaksi);

        $result = $this->transaksiRepository->findById($transaksi->getIdTransaksi());

        assertEquals($result->getIdTransaksi(), $transaksi->getIdTransaksi());
    }

    public function testDeleteSuccess()
    {
        $transaksi = new Transaksi();
        $transaksi->setId(21);
        $transaksi->setTransaksiKode('BM');
        $transaksi->setIdTransaksi($transaksi->getTransaksiKode() . "-" . sprintf('%06s', $transaksi->getId()));
        $transaksi->setTanggalTransaksi(new DateTime());
        $transaksi->setDeskripsi('');
        $this->transaksiRepository->save($transaksi);

        $this->transaksiRepository->deleteById($transaksi->getIdTransaksi());

        $result = $this->transaksiRepository->findById($transaksi->getIdTransaksi());

        assertNull($result);
    }


}
