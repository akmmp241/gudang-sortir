<?php

namespace Akmalmp\GudangSortir\Domain;

class Barang
{
    private string $id_barang;
    private string $nama_barang;
    private int $kuantitas = 0;
    private ?string $deskripsi = '';
    private string $id_kategori;

    /**
     * @return string
     */
    public function getIdBarang(): string
    {
        return $this->id_barang;
    }

    /**
     * @param string $id_barang
     */
    public function setIdBarang(string $id_barang): void
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
     * @return string
     */
    public function getIdKategori(): string
    {
        return $this->id_kategori;
    }

    /**
     * @param string $id_kategori
     */
    public function setIdKategori(string $id_kategori): void
    {
        $this->id_kategori = $id_kategori;
    }
}