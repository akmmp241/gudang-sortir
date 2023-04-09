<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationUserException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Session\SessionService;
use App\Services\Session\SessionServiceImplement;
use App\Services\User\UserService;
use App\Services\User\UserServiceImplement;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserServiceImplement $userService;
    private SessionServiceImplement $sessionService;


    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->userService = app()->make(UserService::class);
        $this->sessionService = app()->make(SessionService::class);
    }

    public function register(): View
    {
        return view('User.register', [
            'title' => 'register'
        ]);
    }

    public function postRegister(RegisterRequest $request): RedirectResponse
    {
        try {
            $this->userService->register($request);
            return redirect('/users/login');
        } catch (Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function login(): View
    {
        return view('User.login', [
            'title' => 'Login'
        ]);
    }

    public function postLogin(LoginRequest $request): RedirectResponse
    {
        try {
            $user = $this->userService->login($request);
            $this->sessionService->creating($user->id);
            return redirect()->intended('/dashboard');
        } catch (ValidationUserException $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function logout(): RedirectResponse
    {
        $this->sessionService->destroying();
        return redirect('/');
    }

    public function profile(): View
    {
        $user = $this->sessionService->current();
        return view('User.profile', [
            'user' => $user
        ]);
    }

    public function postUpdateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        $userId = $this->sessionService->current()->id;
        $request->id = $userId;
        try {
            $this->userService->updateProfile($request);
            return redirect()->back()->with(['message' => 'update profile success']);
        } catch (ValidationUserException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updatePassword(): View
    {
        return view('User.password', [
            'title' => 'update password'
        ]);
    }

    public function postUpdatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $userId = $this->sessionService->current()->id;
        $request->id = $userId;
        try {
            $this->userService->updatePassword($request);
            return redirect('/dashboard');
        } catch (ValidationUserException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
