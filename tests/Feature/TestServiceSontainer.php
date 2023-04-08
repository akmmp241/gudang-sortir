<?php

namespace Tests\Feature;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Services\User\UserService;
use App\Services\User\UserServiceImplement;
use Tests\TestCase;

class TestServiceSontainer extends TestCase
{
    public function testContainer()
    {
        $repo1 = $this->app->make(UserRepository::class);
        $repo2 = new UserRepositoryImplement();
        $service1 = $this->app->make(UserService::class);
        $service2 = new UserServiceImplement(new UserRepositoryImplement());

        self::assertEquals($repo1::class, $repo2::class);
        self::assertEquals($service1::class, $service2::class);
    }

}
