<?php

namespace Akmalmp\GudangSortir\Domain;

class JenisTransaksi
{
    private static string $kode_trasaksi;
    private string $nama_transaksi;
    private string $deskripsi = '';

    /**
     * @return string
     */
    public static function getKodeTrasaksi(): string
    {
        return self::$kode_trasaksi;
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