<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WithdrawalController;



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
?>