<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\Barang;
use PDO;

class BarangRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Barang $barang): Barang
    {
        $statement = $this->connection->prepare("INSERT INTO barang
            (id_barang, nama_barang, kuantitas, deskripsi, id_kategori) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([
            $barang->getIdBarang(),
            $barang->getNamaBarang(),
            $barang->getKuantitas(),
            $barang->getDeskripsi(),
            $barang->getIdKategori()
        ]);
        return $barang;
    }

    public function findAll(): ?array
    {
        $statement = $this->connection->query("SELECT id_barang, nama_barang, kuantitas, deskripsi, id_kategori FROM barang");
        try {
            if ($data = $statement->fetchAll()) {
                return $data;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findById(string $id): ?Barang
    {
        $statement = $this->connection->prepare(
            "SELECT id_barang, nama_barang, kuantitas, deskripsi, id_kategori FROM barang WHERE id_kategori = ?"
        );
        $statement->execute([$id]);
        try {
            if ($row = $statement->fetch()) {
                $barang = new Barang();
                $barang->setIdBarang($row['id_barang']);
                $barang->setNamaBarang($row['nama_barang']);
                $barang->setKuantitas($row['kuantitas']);
                $barang->setDeskripsi($row['deskripsi']);
                $barang->setIdKategori($row['id_kategori']);
                return $barang;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByNamaBarang(string $nama): ?Barang
    {
        $statement = $this->connection->prepare(
            "SELECT id_barang, nama_barang, kuantitas, deskripsi, id_kategori FROM barang WHERE nama_barang = ?"
        );
        $statement->execute([$nama]);
        try {
            if ($row = $statement->fetch()) {
                $barang = new Barang();
                $barang->setIdBarang($row['id_barang']);
                $barang->setNamaBarang($row['nama_barang']);
                $barang->setKuantitas($row['kuantitas']);
                $barang->setDeskripsi($row['deskripsi']);
                $barang->setIdKategori($row['id_kategori']);
                return $barang;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function getMaxId(): ?string
    {
        $statement1 = $this->connection->query("SELECT max(id_barang) as id_barang FROM barang");
        $row = $statement1->fetch();
        return $row['id_barang'];
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM barang WHERE id_barang = ?");
        $statement->execute([$id]);
    }
}