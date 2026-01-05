<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EspaceController;
use App\Http\Middleware\IsAdminMiddleware;

//Anonyme
Route::view('/', 'landingpage')->name('home');
Route::view('/rgpd', 'rgpd')->name('rgpd');
Route::get('/espaces', [EspaceController::class, 'index'])->name('espaces.index');

//Connecté
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
    Volt::route('settings/reservations', 'settings.reservations')->name('reservations.edit');
    Volt::route('settings/historique', 'settings.historique')->name('historique.edit');


    Route::resource('reservations', ReservationController::class);
    Route::get('/reservations/{espace}/calendar', [ReservationController::class, 'calendar'])
        ->name('reservations.calendar');
    //liste + detail
    Route::resource('espaces', EspaceController::class)->except(['index']);

    //ADMIN
    Route::prefix('admin')
        ->as('admin.')
        ->middleware(IsAdminMiddleware::class)
        ->group(function () {

            Route::get('/', function () {
                return redirect()->route('admin.dashboard');
            });

            Route::view('dashboard', 'dashboard')->name('dashboard');

            Route::resource('espaces', EspaceController::class);
            Route::resource('categories', CategorieController::class);
        });

});
