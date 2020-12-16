<?php

namespace App\Providers;

use App\Services\CommentService;
use App\Services\CommentServiceImpl;
use App\Services\GenreService;
use App\Services\GenreServiceImpl;
use App\Services\MovieService;
use App\Services\MovieServiceImpl;
use App\Services\ReactionService;
use App\Services\ReactionServiceImpl;
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
        $this->app->bind(ReactionService::class, ReactionServiceImpl::class);
        $this->app->bind(CommentService::class, CommentServiceImpl::class);
    }
}
