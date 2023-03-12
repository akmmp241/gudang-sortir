<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\DetailTransaksi;
use Akmalmp\GudangSortir\Domain\Transaksi;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\TransaksiBarangRequest;
use Akmalmp\GudangSortir\Model\TransaksiBarangResponse;
use Akmalmp\GudangSortir\Repository\BarangRepository;
use Akmalmp\GudangSortir\Repository\DetailTransaksiRepository;
use Akmalmp\GudangSortir\Repository\JenisTransaksiRepository;
use Akmalmp\GudangSortir\Repository\TransaksiRepository;
use Exception;

class TransaksiService
{
    private JenisTransaksiRepository $jenisTransaksiRepository;
    private TransaksiRepository $transaksiRepository;
    private DetailTransaksiRepository $detailTransaksiRepository;
    private BarangRepository $barangRepository;

    /**
     * @param JenisTransaksiRepository $jenisTransaksiRepository
     * @param TransaksiRepository $transaksiRepository
     * @param DetailTransaksiRepository $detailTransaksiRepository
     * @param BarangRepository $barangRepository
     */
    public function __construct(JenisTransaksiRepository $jenisTransaksiRepository, TransaksiRepository $transaksiRepository, DetailTransaksiRepository $detailTransaksiRepository, BarangRepository $barangRepository)
    {
        $this->jenisTransaksiRepository = $jenisTransaksiRepository;
        $this->transaksiRepository = $transaksiRepository;
        $this->detailTransaksiRepository = $detailTransaksiRepository;
        $this->barangRepository = $barangRepository;
    }

    /**
     * @throws Exception
     */
    public function barangMasuk(TransaksiBarangRequest $request): TransaksiBarangResponse
    {
        $this->validateTransaksiBarangRequest($request);
        try {

            Database::beginTransaction();

            $jenisTransaksi = $this->jenisTransaksiRepository->findByCode("BM");

            $transaksi = new Transaksi();
            $transaksi->setId(sprintf('%d', explode('-', $request->getIdTransaksi())[1]));
            $transaksi->setIdTransaksi($request->getIdTransaksi());
            $transaksi->setTransaksiKode($jenisTransaksi->getKodeTrasaksi());
            $transaksi->setTanggalTransaksi($request->getTanggal());
            $transaksi->setDeskripsi($request->getDeskripsi());

            $this->transaksiRepository->save($transaksi);

            $barang = $this->barangRepository->findByIdBarang($request->getIdBarang());
            $transaksiAfter = $this->transaksiRepository->findById($transaksi->getIdTransaksi());

            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->setIdTransaksi($transaksiAfter->getIdTransaksi());
            $detailTransaksi->setIdBarang($barang->getIdBarang());
            $detailTransaksi->setKuantitas($request->getKuantitas());
            $detailTransaksi->setDeskripsi($request->getDeskripsi());

            $this->detailTransaksiRepository->save($detailTransaksi);

            $detailTransaksi = $this->detailTransaksiRepository->findById($detailTransaksi->getIdTransaksi());
            $barang->setKuantitas($barang->getKuantitas() + $detailTransaksi->getKuantitas());

            $this->barangRepository->update($barang);

            Database::commitTransaction();

            $response = new TransaksiBarangResponse();
            $response->setDetailTransaksi($detailTransaksi);
            $response->setTanggal($transaksi->getTanggalTransaksi());

            return $response;

        } catch (Exception $exception) {

            Database::rollbackTransaction();

            throw $exception;

        }
    }

    /**
     * @throws Exception
     */
    public function barangKeluar(TransaksiBarangRequest $request): TransaksiBarangResponse
    {
        $this->validateTransaksiBarangRequest($request);
        try {

            $barang = $this->barangRepository->findByIdBarang($request->getIdBarang());

            if ($request->getKuantitas() > $barang->getKuantitas()) {
                throw new ValidationExcepetion("Barang tidak bisa keluar melebihi stok");
            }

            Database::beginTransaction();

            $jenisTransaksi = $this->jenisTransaksiRepository->findByCode("BK");

            $transaksi = new Transaksi();
            $transaksi->setId(sprintf('%d', explode('-', $request->getIdTransaksi())[1]));
            $transaksi->setIdTransaksi($request->getIdTransaksi());
            $transaksi->setTransaksiKode($jenisTransaksi->getKodeTrasaksi());
            $transaksi->setTanggalTransaksi($request->getTanggal());
            $transaksi->setDeskripsi($request->getDeskripsi());

            $this->transaksiRepository->save($transaksi);

            $barang = $this->barangRepository->findByIdBarang($request->getIdBarang());
            $transaksiAfter = $this->transaksiRepository->findById($transaksi->getIdTransaksi());

            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->setIdTransaksi($transaksiAfter->getIdTransaksi());
            $detailTransaksi->setIdBarang($barang->getIdBarang());
            $detailTransaksi->setKuantitas($request->getKuantitas());
            $detailTransaksi->setDeskripsi($request->getDeskripsi());

            $this->detailTransaksiRepository->save($detailTransaksi);

            $detailTransaksi = $this->detailTransaksiRepository->findById($detailTransaksi->getIdTransaksi());
            $barang->setKuantitas($barang->getKuantitas() - $detailTransaksi->getKuantitas());

            $this->barangRepository->update($barang);

            Database::commitTransaction();

            $response = new TransaksiBarangResponse();
            $response->setDetailTransaksi($detailTransaksi);
            $response->setStok($request->getKuantitas());
            $response->setTanggal($request->getTanggal());

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    private function validateTransaksiBarangRequest(TransaksiBarangRequest $request): void
    {
        if ($request->getTanggal() == null || $request->getKuantitas() == null ||
            trim($request->getTanggal() == "")) {
            throw new ValidationExcepetion("Isi semua data");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getDeskripsi())) {
            throw new ValidationExcepetion("Deskripsi tidak boleh mengandung karakter spesial");
        }

        if (trim($request->getIdBarang()) == "kosong") {
            throw new ValidationExcepetion("Transaksi tidak valid 2");
        }

        if ((int)$request->getKuantitas() <= 0) {
            throw new ValidationExcepetion("Transaksi tidak valid 3");
        }
    }

    public function getMaxId(): string
    {
        $transaksi = $this->transaksiRepository->getMaxId();
        $transaksi++;
        return sprintf("%06s", $transaksi);
    }

    public function getDataTransaksi(): ?array
    {
        $data = $this->detailTransaksiRepository->getTransaksiHistori();
        if ($data == null) {
            return null;
        }
        return $data;
    }
}