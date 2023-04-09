<?php

namespace App\Exceptions;

use Exception;


class ValidationCategoryException extends Exception
{
    /**
     * @throws self
     */
    public static function blank()
    {
        throw new self('Id dan Nama kategori tidak boleh kosong');
    }

    /**
     * @throws self
     */
    public static function idNotValid()
    {
        throw new self('Id harus kapital dan tidak boleh mengandung karakter spesial');
    }

    /**
     * @throws self
     */
    public static function nameNotValid()
    {
        throw new self('Nama kategori tidak boleh mengandung karakter spesial');
    }

    /**
     * @throws self
     */
    public static function descriptionNotValid()
    {
        throw new self('Deskripsi tidak boleh mengandung karakter spesial');
    }

    /**
     * @throws self
     */
    public static function idMinimum()
    {
        throw new self('id maksimal 10 huruf');
    }

    /**
     * @throws self
     */
    public static function deleteFailed()
    {
        throw new self('Terdapat barang dengan kategori tersebut');
    }

    /**
     * @throws self
     */
    public static function duplicate()
    {
        throw new self('kategori sudah tersedia');
    }
}











