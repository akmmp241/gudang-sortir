<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class DetailTransaksiRepositoryTest extends TestCase
{
    private DetailTransaksiRepository $detailTransaksiRepository;

    protected function setUp(): void
    {
        $this->detailTransaksiRepository = new DetailTransaksiRepository(Database::getConnection());
    }


    public function testHistory()
    {
        $transaksiHistori = $this->detailTransaksiRepository->getTransaksiHistori();

//        print_r($transaksiHistori);
        foreach ($transaksiHistori as $item) {
            echo $item['id_transaksi'] . PHP_EOL;
            echo $item['jenis_transaksi'] . PHP_EOL;
            echo $item['tanggal_transaksi'] . PHP_EOL;
            echo $item['barang_masuk'] . PHP_EOL;
            echo $item['id_barang'] . PHP_EOL;
            echo $item['nama_barang'] . PHP_EOL;
            echo $item['deskripsi'] . PHP_EOL;
            echo PHP_EOL;
        }
        assertNotNull($transaksiHistori);

    }

}
