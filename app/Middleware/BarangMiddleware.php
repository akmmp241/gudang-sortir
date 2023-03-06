<?php

namespace Akmalmp\GudangSortir\Middleware;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Repository\BarangRepository;
use Akmalmp\GudangSortir\Service\BarangService;

class BarangMiddleware
{
    private BarangService $barangService;

    public function __construct()
    {
        $barangRepository = new BarangRepository(Database::getConnection());
        $this->barangService = new BarangService($barangRepository);
    }

    public function before(): void
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parseUrl = parse_url($url, PHP_URL_PATH);
        $idBarang = explode("/", $parseUrl)[4];

        $barang = $this->barangService->findBarangByIdBarang($idBarang);
        if ($barang == null) {
            View::redirect('/dashboard/barang');
        }
    }
}