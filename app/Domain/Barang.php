<?php

namespace Akmalmp\GudangSortir\Domain;

class Barang
{
    private ?int $id_barang;
    private string $nama_barang;
    private int $kuantitas = 0;
    private ?string $deskripsi = '';
    private int $id_kategori;

    /**
     * @return int|null
     */
    public function getIdBarang(): ?int
    {
        return $this->id_barang;
    }

    /**
     * @param int|null $id_barang
     */
    public function setIdBarang(?int $id_barang): void
    {
        $this->id_barang = $id_barang;
    }

    /**
     * @return string
     */
    public function getNamaBarang(): string
    {
        return $this->nama_barang;
    }

    /**
     * @param string $nama_barang
     */
    public function setNamaBarang(string $nama_barang): void
    {
        $this->nama_barang = $nama_barang;
    }

    /**
     * @return int
     */
    public function getKuantitas(): int
    {
        return $this->kuantitas;
    }

    /**
     * @param int $kuantitas
     */
    public function setKuantitas(int $kuantitas): void
    {
        $this->kuantitas = $kuantitas;
    }

    /**
     * @return string|null
     */
    public function getDeskripsi(): ?string
    {
        return $this->deskripsi;
    }

    /**
     * @param string|null $deskripsi
     */
    public function setDeskripsi(?string $deskripsi): void
    {
        $this->deskripsi = $deskripsi;
    }

    /**
     * @return int
     */
    public function getIdKategori(): int
    {
        return $this->id_kategori;
    }

    /**
     * @param int $id_kategori
     */
    public function setIdKategori(int $id_kategori): void
    {
        $this->id_kategori = $id_kategori;
    }


}