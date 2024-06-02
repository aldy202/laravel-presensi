<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShiftController;
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
    return view('pages.auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Periksa peran pengguna saat ini
        if (Auth::user()->role === 'admin') {
            // Route::resources('/dashboard', [DashboardController::class, 'index']);
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            return app(DashboardController::class)->index();
        } else {

            return view('pages.karyawan.dashboard');
        }
    })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('presensi', PresensiController::class);
    Route::get('/history-presensi', [PresensiController::class, 'history'])->name('presensi.history');
    Route::get('/history-all', [PresensiController::class, 'historyAll'])->name('presensi.historyAll');
    Route::delete('/presensi/{id}', [PresensiController::class, 'destroy']);
    Route::get('/presensiexport', [PresensiController::class, 'export'])->name('presensi.export');
    Route::resource('timeshifts', ShiftController::class);
});
