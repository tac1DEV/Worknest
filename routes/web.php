<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EspaceController;
use App\Http\Middleware\IsAdminMiddleware;

//Anonyme
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/espaces', [EspaceController::class, 'index'])->name('espaces.index');

//Connecté
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Route::resource('reservations', ReservationController::class);
    Route::get('/espaces', [EspaceController::class, 'index'])->name('espaces.index');

    //ADMIN
    Route::get('admin/', function () {
        return redirect('/admin/dashboard');
    })->middleware(IsAdminMiddleware::class);
    Route::view('admin/dashboard', 'dashboard')->middleware(IsAdminMiddleware::class)->name('admin.dashboard');

    Route::prefix('admin')
        ->as('admin.')
        ->middleware(IsAdminMiddleware::class)
        ->group(function () {
            Route::view('admin/dashboard', 'dashboard');
            Route::resource('espaces', EspaceController::class);
            Route::resource('categories', CategorieController::class);
        });
});
