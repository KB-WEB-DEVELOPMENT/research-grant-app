<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Finance;

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
        Route::model('finance',Finance::class);
    }
}
