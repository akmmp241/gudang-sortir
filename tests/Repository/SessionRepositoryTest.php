<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Session;
use Akmalmp\GudangSortir\Domain\User;
use PHPUnit\Framework\TestCase;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->sessionRepository =  new SessionRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();

        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();

        $user = new User();
        $user->setEmail("wow@gmail.com");
        $user->setNama("kamal");
        $user->setPassword("1234567");
        $this->userRepository->save($user);
    }

    public function testSaveSuccess()
    {
        $session = new Session();
        $session->setId(uniqid());
        $session->setUserId(33);
        $session->setUserEmail("wow@gmail.com");
        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->getId());

        self::assertEquals($session->getId(), $result->getId());
        self::assertEquals($session->getUserId(), $result->getUserId());
        self::assertEquals($session->getUserEmail(), $result->getUserEmail());
    }

    public function testDeleteByIdSuccess()
    {
        $sessions = new Session();
        $sessions->setId(uniqid());
        $sessions->setUserId(34);
        $sessions->setUserEmail("wow@gmail.com");

        $this->sessionRepository->save($sessions);

        $result = $this->sessionRepository->findById($sessions->getId());

        $this->sessionRepository->deleteById($sessions->getId());

        $result = $this->sessionRepository->findById($sessions->getId());

        self::assertNull($result);
    }

    public function testFindByIdNotFound()
    {
        $result = $this->sessionRepository->findById("notfound");
        self::assertNull($result);
    }


}
