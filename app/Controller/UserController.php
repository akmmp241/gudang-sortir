<?php

namespace Akmalmp\GudangSortir\Controller;

use Akmalmp\GudangSortir\App\View;
use Akmalmp\GudangSortir\Config\Database;
use Akmalmp\GudangSortir\Model\UserRegisterRequest;
use Akmalmp\GudangSortir\Repository\UserRepository;
use Akmalmp\GudangSortir\Service\UserService;
use Exception;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }


    public function register(): void
    {
        View::render('User/register', []);
    }

    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->setEmail($_POST['email']);
        $request->setNama($_POST['nama']);
        $request->setPassword($_POST['password']);
        $request->setKonfirmasiPassword($_POST['konfirmasi-password']);

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
        View::render('User/login', [
            'title' => "waw"
        ]);
    }
}