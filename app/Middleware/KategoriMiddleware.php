<?php

namespace Akmalmp\GudangSortir\Middleware;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use Akmalmp\GudangSortir\Service\KategoriService;

class KategoriMiddleware
{
    private KategoriService $kategoriService;

    public function __construct()
    {
        $kategoriRepository = new KategoriRepository(Database::getConnection());
        $this->kategoriService = new KategoriService($kategoriRepository);
    }

    public function before(): void
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parseUrl = parse_url($url, PHP_URL_PATH);
        $idKategori = explode("/", $parseUrl)[4];

        $kategori = $this->kategoriService->findKategoriById($idKategori);
        if ($kategori == null) {
            View::redirect('/dashboard/kategori');
        }
    }
}