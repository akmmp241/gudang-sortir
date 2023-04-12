<?php

namespace App\Services\Session;

use App\Models\Session;
use App\Models\User;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\UserRepository;
use LaravelEasyRepository\Service;

class SessionServiceImplement extends Service implements SessionService
{
    private static string $COOKIE_NAME = "SESSION_TOKEN";
    protected SessionRepository $sessionRepository;
    protected UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }

    public function creating(int $id): void
    {
        $session = new Session();
        $session->token = uniqid();
        $session->id_user = $id;

        $this->sessionRepository->save($session);

        setcookie(self::$COOKIE_NAME, $session->token, time() + (60 * 60 * 24), '/');
//        Cookie::make(self::$COOKIE_NAME, $session->token, 60 * 24, '/');
    }

    public function destroying(): void
    {
        $token = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $this->sessionRepository->deleteByToken($token);

        setcookie(self::$COOKIE_NAME, '', 1, '/');
//        Cookie::forget(self::$COOKIE_NAME, '/');
    }

    public function current(): ?User
    {
        $token = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->sessionRepository->findByToken($token);
        if ($session == null) {
            return null;
        }

        return $session->user;
    }
}
