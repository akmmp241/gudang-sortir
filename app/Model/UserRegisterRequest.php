<?php

namespace Akmalmp\GudangSortir\Model;

class UserRegisterRequest
{
    private string $email;
    private string $nama;
    private string $password;
    private string $konfirmasiPassword;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @param string $nama
     */
    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getKonfirmasiPassword(): string
    {
        return $this->konfirmasiPassword;
    }

    /**
     * @param string $konfirmasiPassword
     */
    public function setKonfirmasiPassword(string $konfirmasiPassword): void
    {
        $this->konfirmasiPassword = $konfirmasiPassword;
    }
}