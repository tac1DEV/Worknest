<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EspaceController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ScheduleController;

Route::get('/err', function () {
    return abort(419);
})->name('go-back');

Route::get('/go-back', function () {
    return redirect()->back();
})->name('go-back');

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/payment/success', function () {
    return 'Payment Successful!';
})->name('payment.success');

Route::get('/payment/cancel', function () {
    return 'Payment Canceled.';
})->name('payment.cancel');

//Filtres
Route::get('/apply-filters', [FilterController::class, 'apply'])->name('apply.filters');

//Anonyme
Route::view('/', 'landingpage')->name('home');
Route::view('/rgpd', 'rgpd')->name('rgpd');
Route::get('/espaces', [EspaceController::class, 'index'])->name('espaces.index');

//Connecté
Route::middleware(['auth'])->group(function () {

    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/espaces/{id}/calendar', 'index')->name('schedule.index');
        Route::post('/create-schedule', 'store')->name('schedule.store');
        Route::get('/events', 'getEvents')->name('schedule.events');
        Route::post('/schedule/{id}', 'update')->name('schedule.update');
        Route::get('/schedule/delete/{id}', 'deleteEvent')->name('schedule.deleteEvent');
    });

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
