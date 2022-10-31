<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OpeningHourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeekdayController;
use App\Services\UserRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {

    Route::get('users/professionals', [UserController::class, 'getProfessionals'])->name('users.professionals');
    Route::get('available-times', AvailableTimeController::class)->name('users.availableTimes');

    Route::get('/', function () {
        return inertia('Welcome', props: ['title' => 'edgar']);
    });

    Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');

    Route::resources([
        'configurations' => ConfigurationController::class,
        'opening-hours'  => OpeningHourController::class,
        'appointments'   => AppointmentController::class,
        'articles'       => ArticleController::class,
        'events'         => EventController::class,
        'weekdays'       => WeekdayController::class,
    ]);
    //UserRoute::routes();
});
