<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pertemuan_11\MahasiswaController;
use App\Http\Controllers\Pertemuan_12\PostBeritaController;
use App\Http\Middleware\AlreadyLoginMiddleware;
use App\Http\Middleware\NotYetLoginMiddleware;
use App\Models\Pertemuan_11\Mahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('home');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

Route::get('/mahasiswa-post', function () {
    return Mahasiswa::with('postBerita')->get();
});

Route::get('/home-custom', function () {
    return view('home-custom');
});

Route::get('/mahasiswa-insert-post', [PostBeritaController::class, 'formPostMahasiswa']);

Route::middleware(AlreadyLoginMiddleware::class)->group(function () {

    Route::prefix('/registration')->group(function () {
        Route::get('', [AuthController::class, 'registrationForm'])->name('registration');
        Route::post('', [AuthController::class, 'submitRegistrationCustomerForm']);
    });

    Route::prefix('/registration-seller')->group(function () {
        Route::get('', [AuthController::class, 'registrationSellerForm'])->name('registration-seller');
        Route::post('', [AuthController::class, 'submitRegistrationSellerForm']);
    });

    Route::prefix('/login')->group(function () {
        Route::get('', [AuthController::class, 'loginForm'])->name('login');
        Route::post('', [AuthController::class, 'submitLoginForm']);
    });

});

Route::get('/view', function () {
    return view('toko.input-item');
});

Route::middleware([NotYetLoginMiddleware::class])->group(function () {

    Route::prefix('/account')->group(function () {
        Route::get('', [AccountController::class, 'account'])->name('account');
    });

    Route::prefix('/logout')->group(function () {
        Route::post('', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('/home')->group(function () {
        Route::get('', [HomeController::class, 'homePage'])->name('home');
    });

    Route::prefix('/detail-item')->group(function () {
        Route::get('', [HomeController::class, 'detailItem']);
        Route::post('', [HomeController::class, 'submitPesanan']);
    });

    Route::prefix('/add-products')->group(function () {
        Route::get('', [HomeController::class, 'addItemForm'])->name('add-product');
        Route::post('', [HomeController::class, 'submitAddItemForm']);
    });

    Route::prefix('/payment-status')->group(function () {
        Route::get('', [HomeController::class, 'paymentStatus'])->name('payment-status');
    });

    Route::prefix('/cancel-payment')->group(function () {
        Route::post('', [HomeController::class, 'cancelPayment'])->name('cancel-payment');
    });

    Route::prefix('/payment-success')->group(function () {
        Route::get('', [HomeController::class, 'paymentSuccess'])->name('payment-success');
    });

    Route::prefix('/payment')->group(function () {
        Route::get('', [HomeController::class, 'paymentToMidtrans']);
    });

});
