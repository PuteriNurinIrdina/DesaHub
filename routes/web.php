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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pendaftaran',[RegistrationController::class, 'index'])->name('register.index');
Route::post('/pendaftaran',[RegistrationController::class, 'store'])->name('register.store');
Route::get('/pendaftaran/berjaya',[RegistrationController::class, 'success'])->name('EventRegistration.success');
Route::get('/kehadiran', [AttendanceController::class, 'showAttendancePage'])->name('attendance.page');
Route::post('/kehadiran/pengesahan', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::post('/kehadiran', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::get('/withdraw', [WithdrawalController::class, 'showWithdrawForm'])->name('withdraw.form');
Route::post('/withdraw', [WithdrawalController::class, 'processWithdraw'])->name('withdraw.process');
Route::post('/withdraw/confirm', [WithdrawalController::class, 'confirmWithdrawal'])->name('withdraw.confirm');
Route::get('/peserta', [RegistrationController::class, 'attendees']);
Route::get('/tidakhadir', [RegistrationController::class, 'absent'])->name('non.attendees');
Route::get('/pendaftar', [RegistrationController::class, 'showAllRegistrants']);

Route::get('/home', [GenController::class, 'home'])->name('home');

Route::get('/login', [AccController::class, 'login'])->name("login");
Route::post('/login', [AccController::class, 'loginPost'])->name("login.post");

Route::get('/register', [AccController::class, 'register'])->name("register");
Route::post('/register', [AccController::class, 'registerPost'])->name("register.post");

Route::get('/resetpassword', [AccController::class, 'resetpassword'])->name("resetpassword");
Route::post('/resetpassword', [AccController::class, 'resetpasswordPost'])->name("resetpassword.post");

Route::get('/dashboard', [AccController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/editAcc', [AccController::class, 'editAcc'])->middleware(['auth'])->name('editAcc');
Route::post('/editAcc', [AccController::class, 'editAccPost'])->middleware(['auth'])->name('editAcc.post');
    
Route::post('/logout', [AccController::class, 'logout'])->name('logout');
Route::post('/deleteAcc', [AccController::class, 'deleteAcc'])->name('deleteAcc');

Route::get('/api/products-data', [ChartDataController::class, 'getProductsData']);

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product', [ProductController::class, 'view'])->name('product.view');


?>
