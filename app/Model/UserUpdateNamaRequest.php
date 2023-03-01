<?php

namespace Akmalmp\GudangSortir\Model;

class UserUpdateNamaRequest
{
    private ?int $id;
    private ?string $nama;

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
     * @return string|null
     */
    public function getNama(): ?string
    {
        return $this->nama;
    }

    /**
     * @param string|null $nama
     */
    public function setNama(?string $nama): void
    {
        $this->nama = $nama;
    }


}