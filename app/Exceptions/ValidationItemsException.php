<?php

namespace App\Exceptions;

use Exception;

class ValidationItemsException extends Exception
{
    /**
     * @throws self
     */
    public static function blank()
    {
        throw new self('isi semua data');
    }

    /**
     * @throws self
     */
    public static function nameNotValid()
    {
        throw new self('Nama Barang tidak boleh mengandung karakter spesial');
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
    public static function categoryNotValid()
    {
        throw new self('Belum ada data kategori');
    }

    /**
     * @throws self
     */
    public static function duplicate()
    {
        throw new self('Barang sudah ada');
    }

    /**
     * @throws ValidationItemsException
     */
    public static function quantityFailed()
    {
        throw new self('tidak bisa menghapus barang. stok harus 0');
    }
}
