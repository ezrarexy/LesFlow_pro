<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JBController;
use App\Http\Controllers\OPSController;
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

    Route::POST('getMobil', [Controller::class, 'GetMobil'])->name('getMobil');

    Route::get('/', [pageController::class, 'Index'])->name('home');

    Route::POST('/user/crpass', [ResetPasswordController::class, 'CheckPass'])->name('crPass');

    Route::PUT('/user/chpass', [ResetPasswordController::class, 'ChangePass'])->name('chPass');

    Route::get('/mobil', [pageController::class, 'ListMobil'])->name('inventory');

    Route::get('/logout', [LoginController::class, 'logout'])->name('out');

    Route::POST('/spk/cetak', [Controller::class, 'CetakSPK'])->name('cetakSPK');

});

Route::group(['middleware' => ['auth','jbmid']], function () {
    
    Route::get('/spk', [pageController::class, 'SPK'])->name('spk');

    Route::get('/jual', [pageController::class, 'Jual'])->name('jual');

    Route::get('/beli', [pageController::class, 'Beli'])->name('beli');

    Route::POST('/beli', [JBController::class, 'Beli'])->name('goBeli');

    Route::POST('/jual/upperBottom', [JBController::class, 'JualA'])->name('jualA');

    Route::POST('/jual/bellowBottom', [JBController::class, 'JualB'])->name('jualB');

    Route::POST('/spk/input', [pageController::class, 'InputSPK'])->name('spkIn');

    Route::POST('/spk/submit', [JBController::class, 'InputSPK'])->name('inSPK');
});

Route::group(['middleware' => ['auth','manager']], function () {
    Route::get('/konfirmasi/jual', [pageController::class, 'KonfJual'])->name('konfJual');

    Route::get('/konfirmasi/beli', [pageController::class, 'KonfBeli'])->name('konfBeli');
    
    Route::PATCH('/konfirmasi/jual', [JBController::class, 'KonfirmasiJ'])->name('konfirmasiJ');
    
    Route::PATCH('/konfirmasi/beli', [JBController::class, 'KonfirmasiB'])->name('konfirmasiB');
});

Route::group(['middleware' => ['auth', 'admin']], function () {});

Route::group(['middleware' => ['auth','finance']], function () {

    Route::get('/pembayaran/beli', [pageController::class, 'PayB'])->name('pembayaranB');

    Route::PATCH('/doc/kwitansi/in', [FinanceController::class, 'InKwitansi'])->name('InKwitansi');

    Route::PATCH('/doc/ttBPKB/in', [FinanceController::class, 'InTTbpkb'])->name('InTTbpkb');

    Route::PATCH('/doc/BAST/in', [FinanceController::class, 'InBAST'])->name('InBAST');

    Route::PATCH('/pembayaran/beli', [FinanceController::class, 'BayarBeli'])->name('bayarBeli');

});

Route::group(['middleware' => ['auth','sales']], function () {
    Route::get('/prospek', [pageController::class, 'Prospek'])->name('prospek');

});

Route::group(['middleware' => 'ops'], function () {
    Route::get('/periksa/masuk', [pageController::class, 'PeriksaMasuk'])->name('periksaMasuk');
    
    Route::get('/periksa/keluar', [pageController::class, 'PeriksaKeluar'])->name('periksaKeluar');

    Route::get('/pemeriksaan', [pageController::class, 'Pemeriksaan'])->name('pemeriksaan');

    Route::POST('/periksa/ambil', [OPSController::class, 'Ambil'])->name('OPSambil');

    Route::POST('/periksa/start', [OPSController::class, 'StartPeriksa'])->name('startPeriksa');

    Route::POST('/periksa', [pageController::class, 'Periksa'])->name('periksa');

    ROUTE::PATCH('/qcClick', [OPSController::class, 'QCClick'])->name('QCClick');

    ROUTE::PATCH('/banQC', [OPSController::class, 'BanQC'])->name('banQC');

    ROUTE::PATCH('/periksa', [OPSController::class, 'SubmitQC'])->name('SubmitQC');


});

Route::get('/cekcek', function(){
    return view('checking');
});

Route::get('/cobaUpload', function () {
    return view('cobaUpload');
});

Route::POST('/coba/submit', [JBController::class, 'Cobas']);