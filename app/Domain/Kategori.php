<?php

namespace Akmalmp\GudangSortir\Domain;

class Kategori
{
    private string $id_kategori;
    private string $nama_kategori;
    private string $deskripsi = '';

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

    /**
     * @return string
     */
    public function getNamaKategori(): string
    {
        return $this->nama_kategori;
    }

    /**
     * @param string $nama_kategori
     */
    public function setNamaKategori(string $nama_kategori): void
    {
        $this->nama_kategori = $nama_kategori;
    }

    /**
     * @return string
     */
    public function getDeskripsi(): string
    {
        return $this->deskripsi;
    }

    /**
     * @param string $deskripsi
     */
    public function setDeskripsi(string $deskripsi): void
    {
        $this->deskripsi = $deskripsi;
    }


}