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
        $jenisTransaksiBm = $this->jenisTransaksiRepository->findByCode("BM");
        $jenisTransaksiBk = $this->jenisTransaksiRepository->findByCode("Bk");

        self::assertEquals("BM", $jenisTransaksiBm->getKodeTrasaksi());
        self::assertEquals("BK", $jenisTransaksiBk->getKodeTrasaksi());
    }
}
