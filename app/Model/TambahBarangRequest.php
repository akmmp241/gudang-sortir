<?php

namespace Akmalmp\GudangSortir\Model;

class TambahBarangRequest
{
    private ?string $id_barang;
    private ?string $nama_barang;
    private ?string $deskripsi;
    private ?string $id_kategori;

    /**
     * @return string|null
     */
    public function getIdBarang(): ?string
    {
        return $this->id_barang;
    }

    /**
     * @param string|null $id_barang
     */
    public function setIdBarang(?string $id_barang): void
    {
        $this->id_barang = $id_barang;
    }

    /**
     * @return string|null
     */
    public function getNamaBarang(): ?string
    {
        return $this->nama_barang;
    }

    /**
     * @param string|null $nama_barang
     */
    public function setNamaBarang(?string $nama_barang): void
    {
        $this->nama_barang = $nama_barang;
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
     * @return string|null
     */
    public function getIdKategori(): ?string
    {
        return $this->id_kategori;
    }

    /**
     * @param string|null $id_kategori
     */
    public function setIdKategori(?string $id_kategori): void
    {
        $this->id_kategori = $id_kategori;
    }
}