<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\TransaksiBarangRequest;
use Akmalmp\GudangSortir\Repository\BarangRepository;
use Akmalmp\GudangSortir\Repository\DetailTransaksiRepository;
use Akmalmp\GudangSortir\Repository\JenisTransaksiRepository;
use Akmalmp\GudangSortir\Repository\TransaksiRepository;
use Akmalmp\GudangSortir\Service\BarangService;
use Akmalmp\GudangSortir\Service\TransaksiService;
use DateTime;
use Exception;

class TransaksiController
{
    private TransaksiService $transaksiService;
    private BarangService $barangService;

    public function __construct()
    {
        $connnection = Database::getConnection();
        $jTRepository = new JenisTransaksiRepository($connnection);
        $tRepository = new TransaksiRepository($connnection);
        $dTRepository = new DetailTransaksiRepository($connnection);
        $barangRepository = new BarangRepository($connnection);
        $this->barangService = new BarangService($barangRepository);
        $this->transaksiService = new TransaksiService(
            $jTRepository,
            $tRepository,
            $dTRepository,
            $barangRepository
        );
    }

    public function transaksi(): void
    {
        $transaksi = $this->transaksiService->getDataTransaksi($_GET['field'] ?? 't.id', $_GET['order'] ?? 'ASC');
        View::render('Dashboard/Transaksi/transaksi', [
            'data_transaksi' => $transaksi
        ]);
    }

    public function transaksiBarang(): void
    {
        $tanggalNow = new DateTime;
        $barang = $this->barangService->getAllDataBarang();

        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parseURL = explode('-', explode('/', parse_url($url, PHP_URL_PATH))[3])[1];

        if ($parseURL == "masuk") {
            $halamanBarang = "Dashboard/Transaksi/transaksi-bm";
            $idTransaksi = "BM-" . $this->transaksiService->getMaxId();
        } elseif ($parseURL == "keluar") {
            $halamanBarang = "Dashboard/Transaksi/transaksi-bk";
            $idTransaksi = "BK-" . $this->transaksiService->getMaxId();
        } else {
            $halamanBarang = '';
            $idTransaksi = $this->transaksiService->getMaxId();
        }

        View::render($halamanBarang, [
            'id_transaksi' => $idTransaksi,
            'tanggal' => $tanggalNow->format('Y-m-d H:i'),
            'barang' => $barang
        ]);
    }

    /**
     * @throws Exception
     */
    public function postTransaksiBarang(): void
    {
        $request = new TransaksiBarangRequest();
        $request->setIdTransaksi($_POST['id-transaksi']);
        $request->setTanggal(new DateTime($_POST['tanggal']));
        $request->setDeskripsi($_POST['deskripsi']);
        $request->setIdBarang($_POST['id-barang']);


        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parseURL = explode('-', explode('/', parse_url($url, PHP_URL_PATH))[3])[1];

        try {

            if ($parseURL == "masuk") {
                $request->setKuantitas($_POST['masuk']);
                $this->transaksiService->barangMasuk($request);
            } elseif ($parseURL == "keluar") {
                $request->setKuantitas($_POST['keluar']);
                $this->transaksiService->barangKeluar($request);
            }

            View::redirect('/dashboard/transaksi');

        } catch (Exception $exception) {
            $tanggalNow = new DateTime;
            $barang = $this->barangService->getAllDataBarang();

            if ($parseURL == "masuk") {
                $halamanBarang = "Dashboard/Transaksi/transaksi-bm";
                $idTransaksi = "BM-" . $this->transaksiService->getMaxId();
            } elseif ($parseURL == "keluar") {
                $halamanBarang = "Dashboard/Transaksi/transaksi-bk";
                $idTransaksi = "BK-" . $this->transaksiService->getMaxId();
            } else {
                $halamanBarang = '';
                $idTransaksi = $this->transaksiService->getMaxId();
            }

            View::render($halamanBarang, [
                'id_transaksi' => $idTransaksi,
                'tanggal' => $tanggalNow->format('Y-m-d H:i'),
                'barang' => $barang,
                'error' => $exception->getMessage()
            ]);
        }
    }
}