<?php

namespace Akmalmp\GudangSortir\Model;

use Akmalmp\GudangSortir\Domain\Kategori;

class TambahKategoriResponse
{
    private Kategori $kategori;

    /**
     * @return Kategori
     */
    public function getKategori(): Kategori
    {
        return $this->kategori;
    }

    /**
     * @param Kategori $kategori
     */
    public function setKategori(Kategori $kategori): void
    {
        $this->kategori = $kategori;
    }


}