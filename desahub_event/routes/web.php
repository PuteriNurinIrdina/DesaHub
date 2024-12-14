<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ViewEventController;//controller for community view
Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('event.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('event.destroy');


Route::get('/events/view', [ViewEventController::class, 'view'])->name('events.view');
Route::get('/events/{event}/detail', [ViewEventController::class, 'detail'])->name('events.detail');

/* Route::get('/events/deleted', function () {
    return view('event.deleted');
})->name('event.deleted'); */