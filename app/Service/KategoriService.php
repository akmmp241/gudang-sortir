<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Kategori;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\TambahKategoriRequest;
use Akmalmp\GudangSortir\Model\TambahKategoriResponse;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use Exception;

class KategoriService
{
    private KategoriRepository $kategoriRepository;

    /**
     * @param KategoriRepository $kategoriRepository
     */
    public function __construct(KategoriRepository $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    /**
     * @throws ValidationExcepetion
     */
    public function tambahKategori(TambahKategoriRequest $request): TambahKategoriResponse
    {
        $this->validateTambahKateogoriRequest($request);
        try {
            Database::beginTransaction();

            $kategori = $this->kategoriRepository->findById($request->getIdKategori());
            if ($kategori != null) {
                throw new ValidationExcepetion("Kategori sudah tersedia");
            }

            $kategori = $this->kategoriRepository->findByNamaKategori($request->getNamaKategori());
            if (trim($kategori != null)) {
                throw new ValidationExcepetion("Kategori sudah tersedia");
            }

            $kategori = new Kategori();
            $kategori->setIdKategori($request->getIdKategori());
            $kategori->setNamaKategori($request->getNamaKategori());
            $kategori->setDeskripsi($request->getDeskripsi());

            $this->kategoriRepository->save($kategori);

            $response = new TambahKategoriResponse();
            $response->setKategori($kategori);

            Database::commitTransaction();

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateTambahKateogoriRequest(TambahKategoriRequest $request): void
    {
        if ($request->getIdKategori() == null || $request->getNamaKategori() == null ||
            trim($request->getIdKategori()) == "" || trim($request->getNamaKategori()) == "") {
            throw new ValidationExcepetion("Id dan Nama kategori tidak boleh kosong");
        }

        if (!preg_match("/^[A-Z\s]+$/", $request->getIdKategori())) {
            throw new ValidationExcepetion("Id harus kapital dan tidak boleh mengandung karakter spesial");
        }

        if (!preg_match("/^[A-z\s]+$/", $request->getNamaKategori())) {
            throw new ValidationExcepetion("Nama kategori tidak boleh mengandung karakter spesial");
        }

        if (!preg_match("/^[A-z\s]+$/", $request->getDeskripsi())) {
            throw new ValidationExcepetion("Deskripsi tidak boleh mengandung karakter spesial");
        }
    }

    public function getAllDataKategori(): ?array
    {
        $data = $this->kategoriRepository->findAll();
        if ($data == null) {
            return null;
        }
        return $data;
    }

    /**
     * @throws Exception
     */
    public function deleteKategori(string $id): void
    {
        try {
            Database::beginTransaction();
            $this->kategoriRepository->deleteById($id);
            Database::commitTransaction();
        } catch (Exception $exception) {
            Database::commitTransaction();
            throw $exception;
        }
    }
}