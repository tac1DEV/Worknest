<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EspaceController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\FactureController;

//Filtres
Route::get('/apply-filters', [FilterController::class, 'apply'])->name('apply.filters');

//Anonyme
Route::view('/', 'landingpage')->name('home');
Route::view('/rgpd', 'rgpd')->name('rgpd');
Route::get('/espaces', [EspaceController::class, 'index'])->name('espaces.index');

//Connecté
Route::middleware(['auth'])->group(function () {

    Route::get('/profile/reservations', [ScheduleController::class, 'liste'])->name('profile.reservations');

    Route::get('/facture/{schedule}', [FactureController::class, 'show'])->name('reservation.facture');

    Route::get('/stripe', [StripeController::class, 'index'])->name('stripe.index');
    Route::get('/stripe/payment', [StripeController::class, 'payment'])->name('stripe.payment');
    Route::get('/stripe/payment/success', [StripeController::class, 'success'])->name('stripe.payment.success');

    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/espaces/{id}/calendar', 'index')->name('schedule.index');
        Route::post('/create-schedule', 'store')->name('schedule.store');
        Route::get('/events', 'getEvents')->name('schedule.events');
        Route::post('/schedule/{id}', 'update')->name('schedule.update');
        Route::get('/schedule/delete/{id}', 'deleteEvent')->name('schedule.deleteEvent');
    });

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    //liste + detail
    Route::resource('espaces', EspaceController::class)->except(['index']);

    //ADMIN
    Route::prefix('admin')
        ->as('admin.')
        ->middleware(IsAdminMiddleware::class)
        ->group(function () {
    
            Route::view('dashboard', 'dashboard')->name('dashboard');

            Route::resource('espaces', EspaceController::class);
            Route::resource('categories', CategorieController::class);
        });

});