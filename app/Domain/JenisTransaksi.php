<?php

namespace Akmalmp\GudangSortir\Domain;

class JenisTransaksi
{
    private string $kode_trasaksi;
    private string $nama_transaksi;
    private string $deskripsi = '';

    /**
     * @param string $kode_trasaksi
     */
    public function setKodeTrasaksi(string $kode_trasaksi): void
    {
        $this->kode_trasaksi = $kode_trasaksi;
    }

    /**
     * @param string $nama_transaksi
     */
    public function setNamaTransaksi(string $nama_transaksi): void
    {
        $this->nama_transaksi = $nama_transaksi;
    }

    /**
     * @param string $deskripsi
     */
    public function setDeskripsi(string $deskripsi): void
    {
        $this->deskripsi = $deskripsi;
    }

    /**
     * @return string
     */
    public function getKodeTrasaksi(): string
    {
        return $this->kode_trasaksi;
    }

    /**
     * @return string
     */
    public function getNamaTransaksi(): string
    {
        return $this->nama_transaksi;
    }

    /**
     * @return string
     */
    public function getDeskripsi(): string
    {
        return $this->deskripsi;
    }


}