<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Transaksi;
use DateTime;
use PHPUnit\Framework\TestCase;

class TransaksiRepositoryTest extends TestCase
{
    private TransaksiRepository $transaksiRepository;

    protected function setUp(): void
    {
        $this->transaksiRepository = new TransaksiRepository(Database::getConnection());
    }


    public function testCreate()
    {
        $date = new DateTime();

        $transaksi = new Transaksi();
        $transaksi->setId(30);
        $transaksi->setTransaksiKode("BM");
        $transaksi->setTanggalTransaksi($date);
        $transaksi->setDeskripsi('');

        $this->transaksiRepository->save($transaksi);

        $transaksi = $this->transaksiRepository->findById($transaksi->getId());

        print_r($transaksi);
    }

}
