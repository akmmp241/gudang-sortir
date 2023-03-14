<?php

namespace Akmalmp\GudangSortir\Service;

require_once __DIR__ . '/../Helper/helper.php';

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Session;
use Akmalmp\GudangSortir\Domain\User;
use Akmalmp\GudangSortir\Repository\SessionRepository;
use Akmalmp\GudangSortir\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class SessionServiceTest extends TestCase
{
    private SessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);


        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->setEmail("wow@gmail.com");
        $user->setNama("akmal");
        $user->setPassword("eekmu241");
        $this->userRepository->save($user);
    }

    /**
     * @throws \Exception
     */
    public function testCreate()
    {
        $session = $this->sessionService->create(73, "wow@gmail.com");
        $cookie = SessionService::COOKIE_NAME();
        $this->expectOutputRegex("[{$cookie}: {$session->getId()}]");

        $result = $this->sessionRepository->findById($session->getId());

        self::assertEquals($session->getId(), $result->getId());
    }

    public function testDestroy()
    {
        $session = new Session();
        $session->setId(uniqid());
        $session->setUserId(74);
        $session->setUserEmail("wow@gmail.com");

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::COOKIE_NAME()] = $session->getId();

        $this->sessionService->destroy();

        $cookie = SessionService::COOKIE_NAME();
        $this->expectOutputRegex("[{$cookie}: ]");

        $result = $this->sessionRepository->findById($session->getId());

        self::assertNull($result);
    }

    public function testCurrent()
    {
        $session = new Session();
        $session->setId(uniqid());
        $session->setUserId(75);
        $session->setUserEmail("wow@gmail.com");
        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::COOKIE_NAME()] = $session->getId();

        $user = $this->sessionService->current();
        self::assertNotNull($user);
        self::assertEquals($user->getId(), $session->getUserId());
    }


}
