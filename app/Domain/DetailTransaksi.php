<?php

namespace Akmalmp\GudangSortir\Domain;

class DetailTransaksi
{
    private string $id_transaksi;
    private string $id_barang;
    private int $kuantitas;
    private string $deskripsi = '';

    /**
     * @return int
     */
    public function getIdTransaksi(): string
    {
        return $this->id_transaksi;
    }

    /**
     * @param int $id_transaksi
     */
    public function setIdTransaksi(string $id_transaksi): void
    {
        $this->id_transaksi = $id_transaksi;
    }

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