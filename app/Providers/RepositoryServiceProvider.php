<?php

namespace App\Providers;

use App\Repositories\AnimalRepository;
use App\Repositories\EnclosureRepository;
use App\Repositories\BiographyRepository;
use App\Repositories\Interfaces\AnimalRepositoryInterface;
use App\Repositories\Interfaces\EnclosureRepositoryInterface;
use App\Repositories\Interfaces\BiographyRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            EnclosureRepositoryInterface::class,
            EnclosureRepository::class
        );
        $this->app->bind(AnimalRepositoryInterface::class, AnimalRepository::class);
        $this->app->bind(BiographyRepositoryInterface::class, BiographyRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
