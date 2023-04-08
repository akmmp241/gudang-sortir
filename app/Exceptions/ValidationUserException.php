<?php

namespace App\Exceptions;

use Exception;

class ValidationUserException extends Exception
{
    /**
     * @throws ValidationUserException
     */
    public static function blank()
    {
        throw new self('kolom tidka boleh kosong');
    }

    /**
     * @throws ValidationUserException
     */
    public static function emailNotValid()
    {
        throw new self('email tidak valid');
    }

    /**
     * @throws ValidationUserException
     */
    public static function nameNotValid()
    {
        throw new self('nama tidak boleh ada karakter spesial');
    }

    /**
     * @throws ValidationUserException
     */
    public static function minimumPassword()
    {
        throw new self('password minimal 8 karakter spesial');
    }

    /**
     * @throws ValidationUserException
     */
    public static function confirmNotValid()
    {
        throw new self('konfirmasi password tidak sesuai');
    }

    /**
     * @throws ValidationUserException
     */
    public static function duplicateEmail()
    {
        throw new self('email sudah terdaftar');
    }

    /**
     * @throws ValidationUserException
     */
    public static function loginFailed()
    {
        throw new self('email atau password salah');
    }

    public static function userNotFound()
    {
        throw new self('user tidak ditemukan');
    }

    /**
     * @throws ValidationUserException
     */
    public static function custom(string $message)
    {
        throw new self($message);
    }
}
