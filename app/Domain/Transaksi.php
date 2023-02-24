<?php

namespace Akmalmp\GudangSortir\Domain;

use DateTime;

class Transaksi
{
    private ?int $id;
    private string $transaksi_kode;
    private DateTime $tanggal_transaksi;
    private string $deskripsi = '';

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTransaksiKode(): string
    {
        return $this->transaksi_kode;
    }

    /**
     * @param string $transaksi_kode
     */
    public function setTransaksiKode(string $transaksi_kode): void
    {
        $this->transaksi_kode = $transaksi_kode;
    }

    /**
     * @return DateTime
     */
    public function getTanggalTransaksi(): DateTime
    {
        return $this->tanggal_transaksi;
    }

    /**
     * @param DateTime $tanggal_transaksi
     */
    public function setTanggalTransaksi(DateTime $tanggal_transaksi): void
    {
        $this->tanggal_transaksi = $tanggal_transaksi;
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