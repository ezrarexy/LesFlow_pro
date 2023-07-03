<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\JBController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [pageController::class, 'Login'])->middleware('guest')->name('login');

    Route::post('/login', [LoginController::class, 'in'])->middleware('guest')->name('in');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [pageController::class, 'Index']);

    Route::POST('/user/crpass', [ResetPasswordController::class, 'CheckPass'])->name('crPass');

    Route::PUT('/user/chpass', [ResetPasswordController::class, 'ChangePass'])->name('chPass');

    Route::get('/logout', [LoginController::class, 'logout'])->name('out');

});

Route::group(['middleware' => 'jbmid'], function () {
    Route::get('/spk', [pageController::class, 'SPK'])->name('spk');

    Route::get('/jual', [pageController::class, 'Jual'])->name('jual');

    Route::get('/beli', [pageController::class, 'Beli'])->name('beli');

    Route::POST('/beli', [JBController::class, 'Beli'])->name('goBeli');
});

Route::group(['middleware' => 'manager'], function () {
    Route::get('/konfirmasi/jual', [pageController::class, 'KonfJual'])->name('konfJual');

    Route::get('/konfirmasi/beli', [pageController::class, 'KonfBeli'])->name('konfBeli');
    
    Route::PATCH('/konfirmasi/jual', [JBController::class, 'KonfirmasiJ'])->name('konfirmasiJ');
    
    Route::PATCH('/konfirmasi/beli', [JBController::class, 'KonfirmasiB'])->name('konfirmasiB');
});

Route::group(['middleware' => 'admin'], function () {});

Route::group(['middleware' => 'finance'], function () {

    Route::get('/pembayaran/beli', [pageController::class, 'PayB'])->name('pembayaranB');

    Route::PATCH('/doc/kwitansi/in', [FinanceController::class, 'InKwitansi'])->name('InKwitansi');

    Route::PATCH('/doc/ttBPKB/in', [FinanceController::class, 'InTTbpkb'])->name('InTTbpkb');

    Route::PATCH('/doc/BAST/in', [FinanceController::class, 'InBAST'])->name('InBAST');

    Route::PATCH('/pembayaran/beli', [FinanceController::class, 'BayarBeli'])->name('bayarBeli');

});

Route::group(['middleware' => 'sales'], function () {});

Route::group(['middleware' => 'ops'], function () {});
