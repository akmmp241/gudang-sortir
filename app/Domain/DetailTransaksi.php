<?php

namespace Akmalmp\GudangSortir\Domain;

class DetailTransaksi
{
    private ?int $id_transaksi;
    private ?int $id_barang;
    private int $kuantitas = 0;
    private string $deskripsi = '';

    /**
     * @return int|null
     */
    public function getIdTransaksi(): ?int
    {
        return $this->id_transaksi;
    }

    /**
     * @param int|null $id_transaksi
     */
    public function setIdTransaksi(?int $id_transaksi): void
    {
        $this->id_transaksi = $id_transaksi;
    }

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