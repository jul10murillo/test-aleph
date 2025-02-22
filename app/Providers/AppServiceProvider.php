<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CategoriaRepositoryInterface;
use App\Repositories\CategoriaRepository;
use App\Repositories\Interfaces\CMDBRepositoryInterface;
use App\Repositories\CMDBRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoriaRepositoryInterface::class, CategoriaRepository::class);
        $this->app->bind(CMDBRepositoryInterface::class, CMDBRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
