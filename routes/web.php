<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\EventInviteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('eventsCreation', [EventsController::class, 'create'])
->name('eventsCreation');
Route::post('eventsCreation', [EventsController::class, 'store']);

Route::get('events',  [EventsController::class, 'index'])->name('events');
Route::delete('events/{event}',  [EventsController::class, 'destroy'])->name('events.destroy');

Route::get('eventInvite/{event}',  [eventInviteController::class, 'show'])->name('eventInvite.show');

Route::post('/events/{id}/coaches/', [EventsController::class, 'saveCredentials'])->name('events.saveCredentials');
