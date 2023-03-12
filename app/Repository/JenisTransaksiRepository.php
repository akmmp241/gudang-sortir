<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\JenisTransaksi;
use PDO;

class JenisTransaksiRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findByCode(string $kode): ?JenisTransaksi
    {
        $statement = $this->connection->prepare(
            "SELECT kode_transaksi, nama_trans, deskripsi FROM jenis_transaksi WHERE kode_transaksi = ?"
        );
        $statement->execute([$kode]);
        try {
            if ($row = $statement->fetch()) {
                $jenisTransaksi = new JenisTransaksi();
                $jenisTransaksi->setKodeTrasaksi($row['kode_transaksi']);
                $jenisTransaksi->setNamaTransaksi($row['nama_trans']);
                $jenisTransaksi->setDeskripsi($row['deskripsi']);
                return $jenisTransaksi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}