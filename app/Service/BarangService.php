<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Barang;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\TambahBarangRequest;
use Akmalmp\GudangSortir\Model\TambahBarangResponse;
use Akmalmp\GudangSortir\Repository\BarangRepository;
use Exception;

class BarangService
{
    private BarangRepository $barangRepository;

    /**
     * @param BarangRepository $barangRepository
     */
    public function __construct(BarangRepository $barangRepository)
    {
        $this->barangRepository = $barangRepository;
    }

    /**
     * @throws Exception
     */
    public function tambahBarang(TambahBarangRequest $request): TambahBarangResponse
    {
        $this->validateTambahBarangRequaest($request);
        try {
            Database::beginTransaction();
            $barang = $this->barangRepository->findById($request->getIdBarang());
            if ($barang != null) {
                throw new ValidationExcepetion("Barang sudah ada");
            }

            $barang = $this->barangRepository->findByNamaBarang($request->getNamaBarang());
            if ($barang != null) {
                throw new ValidationExcepetion("Barang sudah ada");
            }

            $kategori = $request->getIdKategori() ;

            $barang = new Barang();
            $barang->setIdBarang($kategori . "-" . $request->getIdBarang());
            $barang->setNamaBarang($request->getNamaBarang());
            $barang->setDeskripsi($request->getDeskripsi());
            $barang->setIdKategori($request->getIdKategori());
            $this->barangRepository->save($barang);

            Database::commitTransaction();

            $response = new TambahBarangResponse();
            $response->setBarang($barang);

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateTambahBarangRequaest(TambahBarangRequest $request): void
    {
        if ($request->getNamaBarang() == null || trim($request->getNamaBarang()) == "") {
            throw new ValidationExcepetion("Isi semua data");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getNamaBarang())) {
            throw new ValidationExcepetion("Nama kategori tidak boleh mengandung karakter spesial");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getDeskripsi())) {
            throw new ValidationExcepetion("Deskripsi tidak boleh mengandung karakter spesial");
        }
    }

    public function getAllDataBarang(): ?array
    {
        $data = $this->barangRepository->findAll();
        if ($data == null) {
            return null;
        }
        return $data;
    }

    /**
     * @throws Exception
     */
    public function deleteBarang(string $id): void
    {
        try {
            Database::beginTransaction();
            $this->barangRepository->deleteById($id);
            Database::commitTransaction();
        } catch (Exception $exception) {
            Database::commitTransaction();
            throw $exception;
        }
    }

    public function idGenerate(): ?string
    {
        $id_barang = $this->barangRepository->getMaxId();
        $id_barang++;
        return sprintf("%05s", $id_barang);
    }
}