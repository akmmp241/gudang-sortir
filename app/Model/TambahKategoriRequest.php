<?php

namespace Akmalmp\GudangSortir\Model;

class TambahKategoriRequest
{
    private ?string $id_kategori;
    private ?string $nama_kategori;
    private ?string $deskripsi;

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

    /**
     * @return string|null
     */
    public function getNamaKategori(): ?string
    {
        return $this->nama_kategori;
    }

    /**
     * @param string|null $nama_kategori
     */
    public function setNamaKategori(?string $nama_kategori): void
    {
        $this->nama_kategori = $nama_kategori;
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
}