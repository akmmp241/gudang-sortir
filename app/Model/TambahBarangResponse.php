<?php

namespace Akmalmp\GudangSortir\Model;

use Akmalmp\GudangSortir\Domain\Barang;

class TambahBarangResponse
{
    private Barang $barang;

    /**
     * @return Barang
     */
    public function getBarang(): Barang
    {
        return $this->barang;
    }

    /**
     * @param Barang $barang
     */
    public function setBarang(Barang $barang): void
    {
        $this->barang = $barang;
    }


}