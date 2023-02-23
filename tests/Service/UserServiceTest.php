<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\User;
use Akmalmp\GudangSortir\Exception\ValidationExcepetion;
use Akmalmp\GudangSortir\Model\UserRegisterRequest;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Exception;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserRepository $userRepository;
    private UserService $userService;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);
        $this->userRepository->deleteAll();
    }

    public function testRegisterSuccess()
    {
        $request = new UserRegisterRequest();
        $request->setEmail("akmal@gmail.com");
        $request->setNama("ajsd");
        $request->setPassword("123456789");
        $request->setKonfirmasiPassword("123456789");

        $response = $this->userService->register($request);

        self::assertEquals($request->getEmail(), $response->getUser()->getEmail());
        self::assertEquals($request->getNama(), $response->getUser()->getNama());
        self::assertNotEquals($request->getPassword(), $response->getUser()->getPassword());

        self::assertTrue(password_verify($request->getPassword(), $response->getUser()->getPassword()));
    }


    public function testRegisterBlank()
    {
        $this->expectException(ValidationExcepetion::class);
        $this->expectExceptionMessage("kolom tidak boleh kosong");

        $request = new UserRegisterRequest();
        $request->setEmail("");
        $request->setNama("ajsd");
        $request->setPassword("12345678");
        $request->setKonfirmasiPassword("12345678");

        $response = $this->userService->register($request);
    }

    public function testRegisterLessThan8()
    {
        $this->expectException(ValidationExcepetion::class);
        $this->expectExceptionMessage("password minimal 8 huruf");

        $request = new UserRegisterRequest();
        $request->setEmail("akmal@gmail.com");
        $request->setNama("ajsd");
        $request->setPassword("123456");
        $request->setKonfirmasiPassword("12345678");

        $response = $this->userService->register($request);
    }

    /**
     * @throws Exception
     */
    public function testRegisterWrongConfirmation()
    {
        $this->expectException(ValidationExcepetion::class);
        $this->expectExceptionMessage("konfirmasi password tidak sesuai");

        $request = new UserRegisterRequest();
        $request->setEmail("akmal@gmail.com");
        $request->setNama("ajsd");
        $request->setPassword("12345678");
        $request->setKonfirmasiPassword("123456789");

        $response = $this->userService->register($request);
    }

    /**
     * @throws Exception
     */
    public function testRegisterDuplicateEmail()
    {
        $user = new User();
        $user->setEmail("akmal@gmail.com");
        $user->setNama("akmal");
        $user->setPassword("12345678");

        $this->userRepository->save($user);

        $this->expectException(ValidationExcepetion::class);
        $this->expectExceptionMessage("email sudah terdaftar");

        $request = new UserRegisterRequest();
        $request->setEmail("akmal@gmail.com");
        $request->setNama("ajsd");
        $request->setPassword("12345678");
        $request->setKonfirmasiPassword("12345678");

        $response = $this->userService->register($request);
    }
}
