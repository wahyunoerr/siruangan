<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
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

Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index')->name('landing');
    Route::get('/q', 'search')->name('ruangan.search');
    Route::get('/manage', 'manage')->name('landing.manage');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::controller(UserManagementController::class)->prefix('user-management')->group(function () {
        Route::get('/index', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::put('/update/{id}', 'update')->name('user.update');
        Route::put('/update-password/{id}', 'updatePassword')->name('user.update-password');
        Route::delete('/destroy/{id}', 'destroy')->name('user.destroy');
    });

    Route::controller(EventController::class)->prefix('event')->group(function () {
        Route::get('/index', 'index')->name('acara.index');
        Route::get('/create', 'create')->name('acara.create');
        Route::get('/edit/{id}', 'edit')->name('acara.edit');
        Route::post('/store', 'store')->name('acara.store');
        Route::put('/update/{id}', 'update')->name('acara.update');
        Route::delete('/delete/{id}', 'destroy')->name('acara.delete');
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::prefix('transaksi')->group(function () {
            Route::get('/', 'index')->name('transaksi');
            Route::post('/upload-bukti/{id}', 'uploadBukti')->name('transaksi.uploadBukti');
            Route::get('/transaksi/invoice/{id}', 'printInvoice')->name('transaksi.printInvoice');
            Route::post('/input-dp/{id}', 'inputDp')->name('transaksi.inputDp');
        });
    });

    Route::controller(LandingController::class)->prefix('landing')->group(function () {
        Route::get('/create', 'create')->name('landing.create');
        Route::post('/store', 'store')->name('landing.store');
        Route::get('/edit/{id}', 'edit')->name('landing.edit');
        Route::put('/update/{id}', 'update')->name('landing.update');
        Route::delete('/destroy/{id}', 'destroy')->name('landing.destroy');
        Route::get('/manage', 'manage')->name('landing.manage');
    });

    Route::resource('suppliers', SupplierController::class);
});

Route::middleware(['auth', 'role:Administrator|Perlengkapan'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->middleware(['auth', 'verified'])->name('dashboard');
        Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
    });

    Route::controller(BookingController::class)->group(function () {
        Route::prefix('dataBooking')->group(function () {
            Route::get('/', 'dataBooking')->name('admin.dataBooking');
            Route::post('/{id}/update-status', 'updateStatus')->name('dataBooking.status');
            Route::get('/periodeCetak', 'periodeCetak')->name('listPeriode.cetak');
            Route::get('/q', 'tableCetak')->name('admin.listCetakBooking');
        });
    });
});

Route::middleware(['auth', 'role:Perlengkapan'])->group(function () {
    Route::controller(RuanganController::class)->prefix('ruangan')->group(function () {
        Route::get('/index', 'index')->name('ruangan.index');
        Route::get('/create', 'create')->name('ruangan.create');
        Route::post('/store', 'store')->name('ruangan.store');
        Route::get('/edit/{id}', 'edit')->name('ruangan.edit');
        Route::put('/update/{id}', 'update')->name('ruangan.update');
        Route::delete('/destroy/{id}', 'destroy')->name('ruangan.destroy');
    });
});

Route::middleware(['auth', 'role:Costumer'])->group(function () {
    Route::controller(BookingController::class)->group(function () {
        Route::prefix('booking')->group(function () {
            Route::get('/', 'bokingCostumerIndex')->name('costumer.formBoking');
            Route::get('/pengajuan', 'bokingCostumer')->name('costumer.boking');
            Route::post('/save', 'simpanBokingCostumer')->name('booking.save');
            Route::post('/upload-bukti/{id}', 'uploadBukti')->name('booking.uploadBukti');
        });

        Route::prefix('booking-costumer')->group(function () {
            Route::get('/', 'indexBookingCostumer')->name('pengajuan.booking');
            Route::post('/upload-berkas/{id}',  'uploadBukti')->name('upload.bukti');
        });
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::prefix('cetak-invoice')->group(function () {
            Route::get('/{id}', 'printUserInvoice')->name('transaksi.printUserInvoice');
        });
    });
});

require __DIR__ . '/auth.php';
