<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Model\UserLoginRequest;
use Akmalmp\GudangSortir\Model\UserRegisterRequest;
use Akmalmp\GudangSortir\Repository\SessionRepository;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Akmalmp\GudangSortir\Service\SessionService;
use Akmalmp\GudangSortir\Service\UserService;
use Exception;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }


    public function register(): void
    {
        View::render('User/register', []);
    }

    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->setEmail(htmlspecialchars($_POST['email']));
        $request->setNama(htmlspecialchars($_POST['nama']));
        $request->setPassword(htmlspecialchars($_POST['password']));
        $request->setKonfirmasiPassword(htmlspecialchars($_POST['konfirmasi-password']));

        try {
            $this->userService->register($request);
            View::redirect('/users/login');
        } catch (Exception $exception) {
            View::render('User/register', [
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function login(): void
    {
        View::render('User/login', []);
    }

    public function postLogin(): void
    {
        $request = new UserLoginRequest();
        $request->setEmail(htmlspecialchars($_POST['email']));
        $request->setPassword(htmlspecialchars($_POST['password']));

        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->getUser()->getId(), $response->getUser()->getEmail());
            View::redirect('/dashboard');
        } catch (Exception $exception) {
            View::render('User/login', [
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function logout(): void
    {
        $this->sessionService->destroy();
        View::redirect('/');
    }
}