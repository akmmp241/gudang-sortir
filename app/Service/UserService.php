<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\User;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\UserRegisterRequest;
use Akmalmp\GudangSortir\Model\UserRegisterResponse;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Exception;

class UserService
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegisterRequest($request);
        try {

            Database::beginTransaction();

            $user = $this->userRepository->findByEmail($request->getEmail());
            if ($user != null) {
                throw new ValidationExcepetion("email sudah terdaftar");
            }

            $user = new User();
            $user->setEmail($request->getEmail());
            $user->setNama($request->getNama());
            $user->setPassword(password_hash($request->getPassword(), PASSWORD_BCRYPT));

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->setUser($user);

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
    private function validateUserRegisterRequest(UserRegisterRequest $request): void
    {
        if ($request->getEmail() == null || $request->getNama() == null || $request->getPassword() == null ||
            $request->getKonfirmasiPassword() == null || trim($request->getEmail()) == "" ||
            trim($request->getNama()) == "" || trim($request->getPassword()) == "" ||
            trim($request->getKonfirmasiPassword()) == "") {
            throw new ValidationExcepetion("kolom tidak boleh kosong");
        }

        if (!filter_var($request->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new ValidationExcepetion("email tidak valid");
        }

        if (!preg_match("/^[A-z]+$/", $request->getNama())) {
            throw new ValidationExcepetion("nama tidak boleh ada karakter spesial");
        }

        if (strlen($request->getPassword()) < 8) {
            throw new ValidationExcepetion("password minimal 8 huruf");
        }

        if ($request->getKonfirmasiPassword() != $request->getPassword()) {
            throw new ValidationExcepetion("konfirmasi password tidak sesuai");
        }
    }
}