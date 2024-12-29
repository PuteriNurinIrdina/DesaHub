<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\AccController;
use App\Http\Controllers\GenController;
use App\Http\Controllers\ChartDataController;

use App\Http\Middleware\CheckAccountStatus;
use App\Http\Controllers\ProductController;


use App\Http\Controllers\EventController;
use App\Http\Controllers\ViewEventController;//controller for community view
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/pendaftaran',[RegistrationController::class, 'index'])->name('register.index');
//Route::post('/pendaftaran',[RegistrationController::class, 'store'])->name('register.store');
Route::get('/event/{event_id}/register',[RegistrationController::class, 'success'])->name('registration.success');
/*Route::get('/pendaftaran',[RegistrationController::class, 'index'])->name('register.index');
Route::post('/pendaftaran',[RegistrationController::class, 'store'])->name('register.store');
Route::get('/pendaftaran/berjaya',[RegistrationController::class, 'success'])->name('EventRegistration.success');*/
Route::get('/event/{event_id}/kehadiran', [AttendanceController::class, 'showAttendancePage'])->name('attendance.page');
//Route::post('/kehadiran/pengesahan', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::post('/event/{event_id}/kehadiran', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::get('/withdraw', [WithdrawalController::class, 'showWithdrawForm'])->name('withdraw.form');
Route::post('/withdraw', [WithdrawalController::class, 'processWithdraw'])->name('withdraw.process');
Route::post('/withdraw/confirm', [WithdrawalController::class, 'confirmWithdrawal'])->name('withdraw.confirm');
//Route::get('/peserta', [RegistrationController::class, 'attendees'])->name('list.peserta');
Route::get('/event/{event_id}/tidakhadir', [RegistrationController::class, 'absent'])->name('non.attendees');
//Route::get('/pendaftar', [RegistrationController::class, 'showAllRegistrants'])->name('list.pendaftar');

Route::get('/home', [GenController::class, 'home'])->name('home');

Route::get('/login', [AccController::class, 'login'])->name("login");
Route::post('/login', [AccController::class, 'loginPost'])->name("login.post");

Route::get('/register', [AccController::class, 'register'])->name("register");
Route::post('/register', [AccController::class, 'registerPost'])->name("register.post");

Route::get('/resetpassword', [AccController::class, 'resetpassword'])->name("resetpassword");
Route::post('/resetpassword', [AccController::class, 'resetpasswordPost'])->name("resetpassword.post");

Route::post('/change-password', [AccController::class, 'changePassword'])->name('changePassword');

Route::get('/dashboard', [AccController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/editAcc', [AccController::class, 'editAcc'])->middleware(['auth'])->name('editAcc');
Route::post('/editAcc', [AccController::class, 'editAccPost'])->middleware(['auth'])->name('editAcc.post');
    
Route::post('/logout', [AccController::class, 'logout'])->name('logout');
Route::post('/deleteAcc', [AccController::class, 'deleteAcc'])->name('deleteAcc');

Route::get('/api/events-data', [ChartDataController::class, 'getEventsData']);
Route::get('/api/products-data', [ChartDataController::class, 'getProductsData']);
Route::get('/api/category-data', [ChartDataController::class, 'getCategoryData'])->name('category.data');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/view', [ProductController::class, 'view'])->name('product.view');



Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('event.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('event.destroy');

Route::get('/states-and-cities', [EventController::class, 'getStatesAndCities']);
// Route to fetch cities based on selected state
Route::get('/get-cities/{stateId}', [EventController::class, 'getCities']);


Route::get('/events/view', [ViewEventController::class, 'view'])->name('events.view');
Route::get('/events/{event}/detail', [ViewEventController::class, 'detail'])->name('events.detail');

/* Route::get('/events/deleted', function () {
    return view('event.deleted');
})->name('event.deleted'); */

Route::get('/user/events', [EventController::class, 'showRegisteredEvents'])->name('user.events');
//Route::get('/register/{event}', [RegistrationController::class, 'index'])->name('event.registration');
//Route::get('/event/{event_id}/registrants', [RegistrationController::class, 'index'])->name('EventRegistration.index');
Route::get('/event/{event_id}/pendaftar', [RegistrationController::class, 'showAllRegistrants'])->name('list.pendaftar');
Route::get('/event/{event_id}/peserta', [RegistrationController::class, 'attendees'])->name('list.peserta');

Route::get('/event/{event_id}/register', [RegistrationController::class, 'showRegistrationForm'])->name('event.register');
//Route::get('/register/{eventId}', [RegistrationController::class, 'showRegistrationForm']);
Route::post('/event/{event_id}/register', [RegistrationController::class, 'store'])->name('register.store');
//Route::get('/register-event/{eventId}', [RegistrationController::class, 'showRegistrationForm']);
Route::get('/withdraw/{event_id}', [WithdrawalController::class, 'showWithdrawForm'])->name('withdraw.registration');

//Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
//Route::get('/pendaftaran/{event_id}', [RegistrationController::class, 'index'])->name('event.registration');
//Route::get('/event/{event_id}/registrants', [RegistrationController::class, 'index'])->name('EventRegistration.index');
/*Route::get('/pendaftar', [RegistrationController::class, 'showAllRegistrants'])->name('list.pendaftar');
Route::get('/peserta-list', [RegistrationController::class, 'showAllRegistrants'])->name('list.peserta');

//Route::get('/event/{event_id}/pendaftaran', [RegistrationController::class, 'index'])->name('EventRegistration.index');
//Route::get('/pendaftaran/{eventId}', [RegistrationController::class, 'showRegistrationForm']);
Route::post('/event/{event_id}/pendaftaran', [RegistrationController::class, 'store'])->name('register.store');
//Route::get('/register-event/{eventId}', [RegistrationController::class, 'showRegistrationForm']);

//Route::post('/event/{event_id}/pendaftaran', [RegistrationController::class, 'store'])->name('register.store');*/


Route::get('/withdraw/{event_id}', [WithdrawalController::class, 'showWithdrawForm'])->name('withdraw.registration');
Route::get('/event-registration', [RegistrationController::class, 'index'])->name('EventRegistration.index');
//Route::post('/event-registration', [RegistrationController::class, 'store'])->name('register.store');
Route::post('/event-registration/{event_id}/pendaftaran', [RegistrationController::class, 'store'])->name('register.store');