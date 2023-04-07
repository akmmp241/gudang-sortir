<?php

namespace App\Providers;

use App\Repositories\Session\SessionRepository;
use App\Repositories\Session\SessionRepositoryImplement;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Services\User\UserService;
use App\Services\User\UserServiceImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserRepository::class => UserRepositoryImplement::class,
        SessionRepository::class => SessionRepositoryImplement::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserServiceImplement($app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
