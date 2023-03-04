<?php

namespace App\Providers;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\WeatherRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\WeatherRepository;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            WeatherRepositoryInterface::class,
            WeatherRepository::class
        );
    }
}
