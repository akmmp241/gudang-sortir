<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use PHPUnit\Framework\TestCase;

class JenisTransaksiRepositoryTest extends TestCase
{
    private JenisTransaksiRepository $jenisTransaksiRepository;

    protected function setUp(): void
    {
        $this->jenisTransaksiRepository = new JenisTransaksiRepository(Database::getConnection());
    }


    public function testGetJT()
    {
        $jenisTransaksi = $this->jenisTransaksiRepository->findByCode("BM");

        self::assertEquals("BM", $jenisTransaksi->getKodeTrasaksi());
    }


}
