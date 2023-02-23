<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\User;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->setId(20);
        $user->setEmail("manpridi@gmail.com");
        $user->setNama("Akmal Manpri");
        $user->setPassword("12345678");
        var_dump($user->getId());
        $this->userRepository->save($user);

        $result = $this->userRepository->findById($user->getId());

        self::assertEquals($result->getNama(), $user->getNama());
        self::assertEquals($result->getEmail(), $user->getEmail());
        self::assertEquals($result->getPassword(), $user->getPassword());

        $result = $this->userRepository->findByEmail($user->getEmail());

        self::assertEquals($result->getNama(), $user->getNama());
        self::assertEquals($result->getEmail(), $user->getEmail());
        self::assertEquals($result->getPassword(), $user->getPassword());
    }

    public function testFindNotFound()
    {
        $user1 = $this->userRepository->findById(1);
        $user2 = $this->userRepository->findByEmail("notfound");
        self::assertNull($user1);
        self::assertNull($user2);
    }
}
