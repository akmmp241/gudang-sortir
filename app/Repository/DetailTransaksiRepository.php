<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\DetailTransaksi;
use PDO;

class DetailTransaksiRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(DetailTransaksi $detailTransaksi): DetailTransaksi
    {
        $statement = $this->connection->prepare(
            "INSERT INTO detail_transaksi (id_transaksi, id_barang, kuantitas, deskripsi) VALUES (?, ?, ?, ?)"
        );
        $statement->execute([
            $detailTransaksi->getIdTransaksi(),
            $detailTransaksi->getIdBarang(),
            $detailTransaksi->getKuantitas(),
            $detailTransaksi->getDeskripsi()
        ]);
        return $detailTransaksi;
    }

    public function findById(string $id): ?DetailTransaksi
    {
        $statement = $this->connection->prepare(
            "SELECT id_transaksi, id_barang, kuantitas, deskripsi FROM detail_transaksi WHERE id_transaksi = ?"
        );
        $statement->execute([$id]);
        try {
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $detailTransaksi = new DetailTransaksi();
                $detailTransaksi->setIdTransaksi($row['id_transaksi']);
                $detailTransaksi->setIdBarang($row['id_barang']);
                $detailTransaksi->setKuantitas($row['kuantitas']);
                $detailTransaksi->setDeskripsi($row['deskripsi']);
                return $detailTransaksi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function getTransaksiHistori(): ?array
    {
        $statement = $this->connection->prepare(
            "SELECT d.id_transaksi       AS id_transaksi,
                           jt.nama_trans       AS jenis_transaksi,
                           t.tanggal_transaksi AS tanggal_transaksi,
                           d.kuantitas         AS barang_masuk,
                           d.id_barang         AS id_barang,
                           b.nama_barang       AS nama_barang,
                           d.deskripsi         AS deskripsi
                    FROM detail_transaksi AS d
                        JOIN transaksi t        ON t.id_transaksi   = d.id_transaksi
                        JOIN barang b           ON d.id_barang      = b.id_barang
                        JOIN jenis_transaksi jt ON t.kode_transaksi = jt.kode_transaksi 
                    ORDER BY t.id"
        );
        $statement->execute([]);
        try  {
            if ($data = $statement->fetchAll(PDO::FETCH_ASSOC)) {
                return $data;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}