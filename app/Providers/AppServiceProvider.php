<?php

namespace App\Providers;

use App\Models\Rental;
use App\Models\Returning;
use App\Observers\RentalObserver;
use App\Observers\ReturningObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        // Mendaftarkan observer
        Returning::observe(ReturningObserver::class);
        Rental::observe(RentalObserver::class);
    }
}
