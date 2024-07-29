<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\OtpRepoInterface;
use App\Repo\OtpRepo;
class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OtpRepoInterface::class,OtpRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
