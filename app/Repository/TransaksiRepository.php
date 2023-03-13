<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\Transaksi;
use DateTime;
use PDO;

class TransaksiRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Transaksi $transaksi): Transaksi
    {
        $statement = $this->connection->prepare(
            "INSERT INTO transaksi (id, id_transaksi, kode_transaksi, tanggal_transaksi, deskripsi) VALUES (?, ?, ?, ?, ?)"
        );
        $statement->execute([
            null,
            $transaksi->getIdTransaksi(),
            $transaksi->getTransaksiKode(),
            $transaksi->getTanggalTransaksi()->format('Y-m-d H:i:s'),
            $transaksi->getDeskripsi()
        ]);
        return $transaksi;
    }

    public function findById(string $id): ?Transaksi
    {
        $statement = $this->connection->prepare(
            "SELECT id, id_transaksi, kode_transaksi, tanggal_transaksi, deskripsi FROM transaksi WHERE id_transaksi = ?"
        );
        $statement->execute([$id]);
        try {
            if ($row = $statement->fetch()) {
                $transaksi = new Transaksi();
                $transaksi->setId($row['id']);
                $transaksi->setIdTransaksi($row['id_transaksi']);
                $transaksi->setTransaksiKode($row['kode_transaksi']);
                $transaksi->setTanggalTransaksi(new DateTime($row['tanggal_transaksi']));
                $transaksi->setDeskripsi($row['deskripsi']);
                return $transaksi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare(
            "DELETE FROM transaksi WHERE id_transaksi = ?"
        );
        $statement->execute([$id]);
    }

    public function getMaxId(): ?int
    {
        $statement1 = $this->connection->query(
            "SELECT max(id) as id FROM transaksi"
        );
        $row = $statement1->fetch();
        return $row['id'];
    }

    public function deleteAll(): void
    {
        $this->connection->exec(
            "DELETE FROM transaksi"
        );
    }
}