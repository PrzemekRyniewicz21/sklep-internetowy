<?php

namespace App\Providers;

use App\Interfaces\HurtowniaRepositoryInterface;
use App\Repositories\HurtowniaRepository;
use Illuminate\Support\ServiceProvider;

class HurtowniaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HurtowniaRepositoryInterface::class, HurtowniaRepository::class);
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
