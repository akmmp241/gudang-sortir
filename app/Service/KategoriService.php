<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Kategori;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\KategoriUpdateRequest;
use Akmalmp\GudangSortir\Model\KategoriUpdateResponse;
use Akmalmp\GudangSortir\Model\TambahKategoriRequest;
use Akmalmp\GudangSortir\Model\TambahKategoriResponse;
use Akmalmp\GudangSortir\Repository\BarangRepository;
use Akmalmp\GudangSortir\Repository\KategoriRepository;
use Exception;

class KategoriService
{
    private KategoriRepository $kategoriRepository;
    private BarangRepository $barangRepository;

    /**
     * @param KategoriRepository $kategoriRepository
     */
    public function __construct(KategoriRepository $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
        $this->barangRepository = new BarangRepository(Database::getConnection());
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

        if (preg_match('/[a-z0-9`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getIdKategori())) {
            throw new ValidationExcepetion("Id harus kapital dan tidak boleh mengandung karakter spesial");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getNamaKategori())) {
            throw new ValidationExcepetion("Nama kategori tidak boleh mengandung karakter spesial");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getDeskripsi())) {
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
            $this->validateDeleteKategori($id);
            $this->kategoriRepository->deleteById($id);
            Database::commitTransaction();
        } catch (Exception $exception) {
            Database::commitTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateDeleteKategori(string $id): void
    {
        if ($this->barangRepository->findByIdKategori($id) != null) {
            throw new ValidationExcepetion("Kategori tidak dapat dihapus");
        }
    }

    /**
     * @throws Exception
     */
    public function ubahKategori(KategoriUpdateRequest $request): KategoriUpdateResponse
    {
        $this->validateKategoriUpdateRequest($request);
        try {
            Database::beginTransaction();
            $kategori = $this->kategoriRepository->findById($request->getIdKategori());

            $kategori->setNamaKategori($request->getNamaKategori());
            $kategori->setDeskripsi($request->getDeskripsi());

            $this->kategoriRepository->update($kategori);

            Database::commitTransaction();

            $response = new KategoriUpdateResponse();
            $response->setKategori($kategori);

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateKategoriUpdateRequest(KategoriUpdateRequest $request): void
    {
        if ($request->getIdKategori() == null || $request->getNamaKategori() == null ||
            trim($request->getIdKategori()) == "" || trim($request->getNamaKategori()) == "") {
            throw new ValidationExcepetion("Id dan Nama kategori tidak boleh kosong");
        }

        if (preg_match('/[a-z0-9`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getIdKategori())) {
            throw new ValidationExcepetion("Id harus kapital dan tidak boleh mengandung karakter spesial");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getNamaKategori())) {
            throw new ValidationExcepetion("Nama kategori tidak boleh mengandung karakter spesial");
        }

        if (preg_match('/[`#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->getDeskripsi())) {
            throw new ValidationExcepetion("Deskripsi tidak boleh mengandung karakter spesial");
        }
    }

    public function findKategoriById(string $id): ?Kategori
    {
        $kategori = $this->kategoriRepository->findById($id);
        if ($kategori == null) {
            return null;
        }
        return $kategori;
    }
}