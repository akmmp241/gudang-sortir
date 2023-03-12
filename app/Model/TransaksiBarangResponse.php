<?php

namespace Akmalmp\GudangSortir\Model;

use Akmalmp\GudangSortir\Domain\DetailTransaksi;
use Akmalmp\GudangSortir\Domain\Transaksi;
use DateTime;

class TransaksiBarangResponse
{
    private DetailTransaksi $detailTransaksi;
    private DateTime $tanggal;
    private int $stok;

    /**
     * @return DetailTransaksi
     */
    public function getDetailTransaksi(): DetailTransaksi
    {
        return $this->detailTransaksi;
    }

    /**
     * @param DetailTransaksi $detailTransaksi
     */
    public function setDetailTransaksi(DetailTransaksi $detailTransaksi): void
    {
        $this->detailTransaksi = $detailTransaksi;
    }

    /**
     * @return DateTime
     */
    public function getTanggal(): DateTime
    {
        return $this->tanggal;
    }

    /**
     * @param DateTime $tanggal
     */
    public function setTanggal(DateTime $tanggal): void
    {
        $this->tanggal = $tanggal;
    }

    /**
     * @return int
     */
    public function getStok(): int
    {
        return $this->stok;
    }

    /**
     * @param int $stok
     */
    public function setStok(int $stok): void
    {
        $this->stok = $stok;
    }


}