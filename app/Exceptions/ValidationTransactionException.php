<?php

namespace App\Exceptions;

use Exception;

class ValidationTransactionException extends Exception
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
    public static function descriptionNotValid()
    {
        throw new self('Deskripsi tidak boleh mengandung karakter spesial');
    }

    /**
     * @throws self
     */
    public static function itemNotValid()
    {
        throw new self('tidak ada item yang dipilih');
    }

    /**
     * @throws self
     */
    public static function minimumTransaction()
    {
        throw new self('jumlah minimum trnsaksi adalah 1');
    }

    /**
     * @throws self
     */
    public static function outOfStock()
    {
        throw new self('barang tidak bisa keluar melebihi stok');
    }
}
