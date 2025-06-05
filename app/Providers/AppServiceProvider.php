<?php

namespace App\Providers;

use App\Models\BukuTamu;
use App\Policies\BukuTamuPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        BukuTamu::class => BukuTamuPolicy::class,
    ];
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}