<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryImplement;
use App\Repositories\Items\ItemsRepository;
use App\Repositories\Items\ItemsRepositoryImplement;
use App\Repositories\Session\SessionRepository;
use App\Repositories\Session\SessionRepositoryImplement;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceImplement;
use App\Services\Items\ItemsService;
use App\Services\Items\ItemsServiceImplement;
use App\Services\Session\SessionService;
use App\Services\Session\SessionServiceImplement;
use App\Services\User\UserService;
use App\Services\User\UserServiceImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserRepository::class => UserRepositoryImplement::class,
        SessionRepository::class => SessionRepositoryImplement::class,
        CategoryRepository::class => CategoryRepositoryImplement::class,
        ItemsRepository::class => ItemsRepositoryImplement::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserServiceImplement($app->make(UserRepository::class));
        });

        $this->app->singleton(SessionService::class, function ($app) {
            return new SessionServiceImplement($app->make(SessionRepository::class), $app->make(UserRepository::class));
        });

        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryServiceImplement($app->make(CategoryRepository::class));
        });

        $this->app->singleton(ItemsService::class, function ($app) {
            return new ItemsServiceImplement($app->make(ItemsRepository::class), $app->make(CategoryRepository::class));
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
