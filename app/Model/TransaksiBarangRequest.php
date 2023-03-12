<?php

namespace Akmalmp\GudangSortir\Model;

use DateTime;

class TransaksiBarangRequest
{
    private ?string $id_transaksi;
    private ?DateTime $tanggal;
    private ?string $id_barang;
    private ?int $kuantitas;
    private ?string $deskripsi;

    /**
     * @return string|null
     */
    public function getIdTransaksi(): ?string
    {
        return $this->id_transaksi;
    }

    /**
     * @param string|null $id_transaksi
     */
    public function setIdTransaksi(?string $id_transaksi): void
    {
        $this->id_transaksi = $id_transaksi;
    }

    /**
     * @return DateTime|null
     */
    public function getTanggal(): ?DateTime
    {
        return $this->tanggal;
    }

    /**
     * @param DateTime|null $tanggal
     */
    public function setTanggal(?DateTime $tanggal): void
    {
        $this->tanggal = $tanggal;
    }

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
     * @return int|null
     */
    public function getKuantitas(): ?int
    {
        return $this->kuantitas;
    }

    /**
     * @param int|null $kuantitas
     */
    public function setKuantitas(?int $kuantitas): void
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
}