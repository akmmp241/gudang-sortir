<?php

namespace Akmalmp\GudangSortir\Service;

use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Domain\Session;
use Akmalmp\GudangSortir\Domain\User;
use Akmalmp\GudangSortir\Repository\SessionRepository;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Exception;

class SessionService
{
    private static string $COOKIE_NAME = "GUDANG_SORTIR_SESSION";
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    /**
     * @param SessionRepository $sessionRepository
     * @param UserRepository $userRepository
     */
    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }

    public static function COOKIE_NAME(): string
    {
        return self::$COOKIE_NAME;
    }

    /**
     * @throws Exception
     */
    public function create(int $user_id, string $email): Session
    {
        $session = new Session();
        $session->setId(uniqid());
        $session->setUserId($user_id);
        $session->setUserEmail($email);
        try {
            Database::beginTransaction();
            $this->sessionRepository->save($session);
            Database::commitTransaction();
        } catch (Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }

        setcookie(self::COOKIE_NAME(), $session->getId(), time() + (60 * 60 * 24), "/");

        return $session;
    }

    public function destroy(): void
    {
        $sessionId = $_COOKIE[self::COOKIE_NAME()] ?? '';
        $this->sessionRepository->deleteById($sessionId);

        setcookie(self::COOKIE_NAME(), '', 1, "/");
    }

    public function current(): ?User
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->sessionRepository->findById($sessionId);
        if ($session == null) {
            return null;
        }

        return $this->userRepository->findById($session->getUserId());
    }
}