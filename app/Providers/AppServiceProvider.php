<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Route;
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
        // Route Model Binding customizado
        Route::bind('categoria', function ($value) {
            return MenuCategory::findOrFail($value);
        });

        Route::bind('item', function ($value) {
            return MenuItem::findOrFail($value);
        });

        Route::bind('galeria', function ($value) {
            return Gallery::findOrFail($value);
        });

        Route::bind('reserva', function ($value) {
            return Reservation::findOrFail($value);
        });

        Route::bind('usuario', function ($value) {
            return User::findOrFail($value);
        });
    }
}
