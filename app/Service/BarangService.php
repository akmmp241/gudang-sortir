<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Barang;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\BarangUpdateRequest;
use Akmalmp\GudangSortir\Model\BarangUpdateResponse;
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
            $barang = $this->barangRepository->findById($request->getId());
            if ($barang != null) {
                throw new ValidationExcepetion("Barang sudah ada");
            }

            $barang = $this->barangRepository->findByNamaBarang($request->getNamaBarang());
            if ($barang != null) {
                throw new ValidationExcepetion("Barang sudah ada");
            }

            $kategori = $request->getIdKategori();

            $barang = new Barang();
            $barang->setId($request->getId());
            $barang->setNamaBarang($request->getNamaBarang());
            $barang->setDeskripsi($request->getDeskripsi());
            $barang->setDeskripsi($request->getDeskripsi());
            $barang->setIdKategori($request->getIdKategori());
            $barang->setIdBarang($barang->getIdKategori() . "-" . $barang->getId());
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

        if (preg_match('/[`#$%^&*()+=\\[\]\';,.\/{}|":<>?~\\\\]/', $request->getNamaBarang())) {
            throw new ValidationExcepetion("Nama Barang tidak boleh mengandung karakter spesial");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getDeskripsi())) {
            throw new ValidationExcepetion("Deskripsi tidak boleh mengandung karakter spesial");
        }

        if ($request->getIdKategori() == null || trim($request->getIdKategori() == "" || $request->getIdKategori() == "kosong")) {
            throw new ValidationExcepetion("Belum ada data kategori");
        }
    }

    /**
     * @throws Exception
     */
    public function ubahBarang(BarangUpdateRequest $request): BarangUpdateResponse
    {
        $this->validateUbahBarangRequest($request);
        try {
            Database::beginTransaction();
            $barang = $this->barangRepository->findByIdBarang($request->getIdBarang());

            $barang->setNamaBarang($request->getNamaBarang());
            $barang->setDeskripsi($request->getDeskripsi());

            $this->barangRepository->update($barang);

            Database::commitTransaction();

            $response = new BarangUpdateResponse();
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
    private function validateUbahBarangRequest(BarangUpdateRequest $request): void
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

    public function getAllDataBarang(?string $sort = null): ?array
    {
        if ($sort == "terlama") {
            $data = $this->barangRepository->findAllDesc();
        } else {
            $data = $this->barangRepository->findAllAsc();
        }
        if ($data == null) {
            return null;
        }
        return $data;
    }

    public function findBarangByIdBarang(string $id): ?Barang
    {
        $barang = $this->barangRepository->findByIdBarang($id);
        if ($barang == null) {
            return null;
        }
        return $barang;
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

    public function getStok(string $id): ?int
    {
        return $this->barangRepository->getStok($id);
    }
}