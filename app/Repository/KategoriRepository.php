<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\Kategori;
use PDO;

class KategoriRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Kategori $kategori): Kategori
    {
        $statement = $this->connection->prepare("INSERT INTO kategori 
                                            (id_kategori, nama_kategori, deskripsi) VALUES (?, ?, ?)");
        $statement->execute([
            $kategori->getIdKategori(),
            $kategori->getNamaKategori(),
            $kategori->getDeskripsi()
        ]);
        return $kategori;
    }

    public function update(Kategori $kategori): Kategori
    {
        $statement = $this->connection->prepare("UPDATE kategori SET nama_kategori = ?, deskripsi = ? WHERE id_kategori = ?");
        $statement->execute([
            $kategori->getNamaKategori(),
            $kategori->getDeskripsi(),
            $kategori->getIdKategori()
        ]);
        return $kategori;
    }

    public function findAll(): ?array
    {
        $statement = $this->connection->query("SELECT id_kategori, nama_kategori, deskripsi FROM kategori");
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

    public function findById(string $id_kategori): ?Kategori
    {
        $statement = $this->connection->prepare("SELECT id_kategori, nama_kategori, deskripsi FROM kategori 
                                            WHERE id_kategori = ?");
        $statement->execute([$id_kategori]);
        try {
            if ($row = $statement->fetch()) {
                $kategori = new Kategori();
                $kategori->setIdKategori($row['id_kategori']);
                $kategori->setNamaKategori($row['nama_kategori']);
                $kategori->setDeskripsi($row['deskripsi']);
                return $kategori;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByNamaKategori(string $nama_kategori): ?Kategori
    {
        $statement = $this->connection->prepare("SELECT id_kategori, nama_kategori, deskripsi FROM kategori 
                                            WHERE nama_kategori = ?");
        $statement->execute([$nama_kategori]);
        try {
            if ($row = $statement->fetch()) {
                $kategori = new Kategori();
                $kategori->setIdKategori($row['id_kategori']);
                $kategori->setNamaKategori($row['nama_kategori']);
                $kategori->setDeskripsi($row['deskripsi']);
                return $kategori;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM kategori WHERE id_kategori = ?");
        $statement->execute([$id]);
        $statement->closeCursor();
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM kategori");
    }
}