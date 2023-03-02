<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\User;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\UserLoginRequest;
use Akmalmp\GudangSortir\Model\UserLoginResponse;
use Akmalmp\GudangSortir\Model\UserRegisterRequest;
use Akmalmp\GudangSortir\Model\UserRegisterResponse;
use Akmalmp\GudangSortir\Model\UserUpdateEmailRequest;
use Akmalmp\GudangSortir\Model\UserUpdateEmailResponse;
use Akmalmp\GudangSortir\Model\UserUpdateNamaRequest;
use Akmalmp\GudangSortir\Model\UserUpdateNamaResponse;
use Akmalmp\GudangSortir\Model\UserUpdatePasswordRequest;
use Akmalmp\GudangSortir\Model\UserUpdatePasswordResponse;
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

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $request->getEmail())) {
            throw new ValidationExcepetion("email tidak valid");
        }

        if (!preg_match("/^[A-z\s]+$/", $request->getNama())) {
            throw new ValidationExcepetion("nama tidak boleh ada karakter spesial");
        }

        if (strlen($request->getPassword()) < 8) {
            throw new ValidationExcepetion("password minimal 8 karakter");
        }

        if ($request->getKonfirmasiPassword() != $request->getPassword()) {
            throw new ValidationExcepetion("konfirmasi password tidak sesuai");
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);
        $user = $this->userRepository->findByEmail($request->getEmail());
        if ($user == null) {
            throw new ValidationExcepetion("Email atau Password salah");
        }

        if (password_verify($request->getPassword(), $user->getPassword())) {
            $response = new UserLoginResponse();
            $response->setUser($user);
            return $response;
        } else {
            throw new ValidationExcepetion("Email atau Password salah");
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateUserLoginRequest(UserLoginRequest $request): void
    {
        if ($request->getEmail() == null || $request->getPassword() == null || trim($request->getEmail()) == "" ||
            trim($request->getPassword()) == "") {
            throw new ValidationExcepetion("Kolom tidak boleh kosong");
        }

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $request->getEmail())) {
            throw new ValidationExcepetion("Email tidak valid");
        }

        if (strlen($request->getPassword()) < 8) {
            throw new ValidationExcepetion("Password minimal 8 karakter");
        }
    }

    /**
     * @throws Exception
     */
    public function updatePassword(UserUpdatePasswordRequest $request): UserUpdatePasswordResponse
    {
        $this->validateUserUpdateRequest($request);
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->getId());
            if ($user == null) {
                throw new ValidationExcepetion("User tidak ditemukan");
            }

            if (!password_verify($request->getOldPassword(), $user->getPassword())) {
                throw new ValidationExcepetion("password lama salah");
            }

            if (password_verify($request->getNewPassword(), $user->getPassword())) {
                throw new ValidationExcepetion("password tidak boleh sama dengan sebelumnya");
            }

            $user->setPassword(password_hash($request->getNewPassword(), PASSWORD_BCRYPT));

            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserUpdatePasswordResponse();
            $response->setUser($user);

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateUserUpdateRequest(UserUpdatePasswordRequest $request): void
    {
        if ($request->getOldPassword() == null || $request->getNewPassword() == null ||
            trim($request->getOldPassword()) == "" || trim($request->getNewPassword()) == "") {
            throw new ValidationExcepetion("kolom tidak boleh kosong");
        }

        if (strlen($request->getOldPassword()) < 8 || strlen($request->getNewPassword()) < 8) {
            throw new ValidationExcepetion("password minimal 8 karakter");
        }
    }

    /**
     * @throws Exception
     */
    public function updateEmail(UserUpdateEmailRequest $request): UserUpdateEmailResponse
    {
        $this->validateUserUpdateEmailRequest($request);
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->getId());
            if ($user == null) {
                throw new ValidationExcepetion("user tidak ditemukan");
            }

            if ($user->getEmail() == $request->getEmail()) {
                throw new ValidationExcepetion("email tidak bisa sama");
            }

            $user->setEmail($request->getEmail());

            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserUpdateEmailResponse();
            $response->setUser($user);

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateUserUpdateEmailRequest(UserUpdateEmailRequest $request): void
    {
        if ($request->getEmail() == null || trim($request->getEmail() == "")) {
            throw new ValidationExcepetion("email tidak boleh kosong");
        }

        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $request->getEmail())) {
            throw new ValidationExcepetion("Email tidak valid");
        }
    }

    /**
     * @throws Exception
     */
    public function updateNama(UserUpdateNamaRequest $request): UserUpdateNamaResponse
    {
        $this->validateUserUpdateNamaRequest($request);
        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->getId());
            if ($user == null) {
                throw new ValidationExcepetion("user tidak ditemukan");
            }

            $user->setNama($request->getNama());

            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserUpdateNamaResponse();
            $response->setUser($user);

            return $response;
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws ValidationExcepetion
     */
    private function validateUserUpdateNamaRequest(UserUpdateNamaRequest $request): void
    {
        if ($request->getNama() == null || trim($request->getNama()) == "") {
            throw new ValidationExcepetion("nama tidak boleh kosong");
        }

        if (!preg_match("/^[A-z\s]+$/", $request->getNama())) {
            throw new ValidationExcepetion("nama tidak boleh ada karakter spesial");
        }
    }
}