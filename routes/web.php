<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(UserManagementController::class)->prefix('user-management')->group(function () {
        Route::get('/index', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::put('/update/{id}', 'update')->name('user.update');
        Route::put('/update-password/{id}', 'updatePassword')->name('user.update-password');
        Route::delete('/destroy/{id}', 'destroy')->name('user.destroy');
    });

    Route::controller(RuanganController::class)->prefix('ruangan')->group(function () {
        Route::get('/index', 'index')->name('ruangan.index');
        Route::get('/create', 'create')->name('ruangan.create');
        Route::post('/store', 'store')->name('ruangan.store');
        Route::get('/edit/{id}', 'edit')->name('ruangan.edit');
        Route::put('/update/{id}', 'update')->name('ruangan.update');
        Route::delete('/destroy/{id}', 'destroy')->name('ruangan.destroy');
    });

    Route::controller(JadwalController::class)->prefix('jadwal')->group(function () {
        Route::get('/index', 'index')->name('jadwal.index');
        Route::get('/create', 'create')->name('jadwal.create');
        Route::post('/store', 'store')->name('jadwal.store');
        Route::get('/edit/{id}', 'edit')->name('jadwal.edit');
        Route::put('/update/{id}', 'update')->name('jadwal.update');
        Route::delete('/destroy/{id}', 'destroy')->name('jadwal.destroy');
    });
});

require __DIR__ . '/auth.php';
