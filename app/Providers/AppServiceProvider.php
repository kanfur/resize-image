<?php

namespace App\Providers;

use App\Repositories\ImageResizeRepository;
use App\Repositories\ImageResizeRepositoryInterface;
use App\Repositories\ImageUploadRepository;
use App\Repositories\ImageUploadRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImageResizeRepositoryInterface::class,ImageResizeRepository::class);
        $this->app->bind(ImageUploadRepositoryInterface::class,ImageUploadRepository::class);
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
