<?php

namespace Akmalmp\GudangSortir\Model;

use Akmalmp\GudangSortir\Domain\Kategori;

class KategoriUpdateResponse
{
    private ?Kategori $kategori;

    /**
     * @return Kategori|null
     */
    public function getKategori(): ?Kategori
    {
        return $this->kategori;
    }

    /**
     * @param Kategori|null $kategori
     */
    public function setKategori(?Kategori $kategori): void
    {
        $this->kategori = $kategori;
    }


}