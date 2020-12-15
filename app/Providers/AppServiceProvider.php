<?php

namespace App\Providers;

use App\Services\GenreService;
use App\Services\GenreServiceImpl;
use App\Services\MovieService;
use App\Services\MovieServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MovieService::class, MovieServiceImpl::class);
        $this->app->bind(GenreService::class, GenreServiceImpl::class);
    }
}
