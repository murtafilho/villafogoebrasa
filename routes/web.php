<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/cardapio', [HomeController::class, 'cardapio'])->name('cardapio');

// Admin Routes
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('reservas', ReservationController::class);
        Route::resource('cardapio/categorias', MenuCategoryController::class)
            ->parameters(['categorias' => 'categoria'])
            ->names([
                'index' => 'cardapio.categorias.index',
                'create' => 'cardapio.categorias.create',
                'store' => 'cardapio.categorias.store',
                'show' => 'cardapio.categorias.show',
                'edit' => 'cardapio.categorias.edit',
                'update' => 'cardapio.categorias.update',
                'destroy' => 'cardapio.categorias.destroy',
            ]);
        Route::resource('cardapio/itens', MenuItemController::class)
            ->parameters(['itens' => 'item'])
            ->names([
                'index' => 'cardapio.itens.index',
                'create' => 'cardapio.itens.create',
                'store' => 'cardapio.itens.store',
                'show' => 'cardapio.itens.show',
                'edit' => 'cardapio.itens.edit',
                'update' => 'cardapio.itens.update',
                'destroy' => 'cardapio.itens.destroy',
            ]);
        Route::patch('cardapio/itens/{item}/toggle-featured', [MenuItemController::class, 'toggleFeatured'])
            ->name('cardapio.itens.toggle-featured');
        Route::resource('galeria', GalleryController::class)->parameters(['galeria' => 'galeria']);
        Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'usuario']);
    });

// Profile Routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
