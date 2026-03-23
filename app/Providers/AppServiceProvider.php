<?php

namespace App\Providers;

use App\Contracts\IImageService;
use App\Service\ImageService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(IImageService::class, ImageService::class);

//        $this->renderable(function (ValidationException $exception, $request) {
//          if (!$request->wantsJson()) {
//              return null;
//          }
//        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
