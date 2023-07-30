<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JBController;
use App\Http\Controllers\ManagerController;
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

    Route::POST('/kwitansi/cetak', [Controller::class, 'CetakKwitansi'])->name('cetakKwitansi');

    Route::POST('/bast/cetak', [Controller::class, 'CetakBAST']);

    Route::GET('/profile', [pageController::class, 'Profile']);

    Route::GET('/qc/res', [Controller::class, 'HasilQC']);

    Route::GET('/dokumen/get', [Controller::class, 'GetDokumen']);

    Route::GET('/bengkel/get', [Controller::class, 'GetBengkel']);

});

Route::group(['middleware' => ['jbmid']], function () {
    
    Route::get('/spk', [pageController::class, 'SPK'])->name('spk');

    Route::get('/jual', [pageController::class, 'Jual'])->name('jual');

    Route::get('/beli', [pageController::class, 'Beli'])->name('beli');

    Route::POST('/beli', [JBController::class, 'Beli'])->name('goBeli');

    Route::POST('/jual/upperBottom', [JBController::class, 'JualA'])->name('jualA');

    Route::POST('/jual/bellowBottom', [JBController::class, 'JualB'])->name('jualB');

    Route::POST('/spk/input', [pageController::class, 'InputSPK'])->name('spkIn');

    Route::POST('/spk/submit', [JBController::class, 'InputSPK'])->name('inSPK');

    Route::GET('/transaksi/riwayat', [pageController::class, 'RiwayatTransaksi']);

    Route::GET('/mobil', [pageController::class, 'ListMobil']);
});

Route::group(['middleware' => ['manager']], function () {
    Route::get('/konfirmasi/jual', [pageController::class, 'KonfJual'])->name('konfJual');

    Route::get('/konfirmasi/beli', [pageController::class, 'KonfBeli'])->name('konfBeli');
    
    Route::PATCH('/konfirmasi/jual', [JBController::class, 'KonfirmasiJ'])->name('konfirmasiJ');
    
    Route::PATCH('/konfirmasi/beli', [JBController::class, 'KonfirmasiB'])->name('konfirmasiB');

    Route::GET('/user', [pageController::class, 'User']);

    Route::POST('/user/add', [ManagerController::class, 'UserAdd']);

    Route::POST('/bottom/set', [ManagerController::class, 'SetBottom']);

    Route::POST('/harga/set', [ManagerController::class, 'SetHarga']);

    Route::GET('/bengkel', [pageController::class, 'Bengkel']);

    Route::POST('/bengkel/add', [ManagerController::class, 'BengkelAdd']);

    Route::DELETE('/bengkel/rm', [ManagerController::class, 'BengkelRm']);

    Route::GET('/asuransi', [pageController::class, 'Asuransi']);

    Route::POST('/asuransi/add', [ManagerController::class, 'AsuransiAdd']);

    Route::DELETE('/asuransi/rm', [ManagerController::class, 'AsuransiRm']);

});

Route::group(['middleware' => [ 'admin']], function () {

    Route::POST('/dokumen/put', [Controller::class, 'PutDokumen']);

    Route::POST('/dokumen/jt', [AdminController::class, 'JatuhTempo']);

});

Route::group(['middleware' => ['finance']], function () {

    Route::get('/listspk', [pageController::class, 'listSPK'])->name('listspk');

    Route::get('/pembayaran/beli', [pageController::class, 'PayB'])->name('pembayaranB');

    Route::PATCH('/doc/kwitansi/in', [FinanceController::class, 'InKwitansi'])->name('InKwitansi');

    Route::PATCH('/doc/ttBPKB/in', [FinanceController::class, 'InTTbpkb'])->name('InTTbpkb');

    Route::PATCH('/doc/BAST/in', [FinanceController::class, 'InBAST'])->name('InBAST');

    Route::PATCH('/pembayaran/beli', [FinanceController::class, 'BayarBeli'])->name('bayarBeli');

    Route::POST('/spk/uangSPK', [FinanceController::class, 'KwitansiSPK'])->name('uangSPK');

    Route::POST('/spk/uangMobil', [FinanceController::class, 'KwitansiMobil'])->name('uangMobil');

    Route::POST('/spk/uangMobil2', [FinanceController::class, 'KwitansiMobil2'])->name('uangMobil2');

});

Route::group(['middleware' => ['sales']], function () {
    Route::get('/prospek', [pageController::class, 'Prospek'])->name('prospek');

});

Route::group(['middleware' => 'ops'], function () {

    Route::get('/deliveryList', [pageController::class, 'DeliveryOrder'])->name('deliveryList');

    Route::get('/periksa/masuk', [pageController::class, 'PeriksaMasuk'])->name('periksaMasuk');
    
    Route::get('/periksa/keluar', [pageController::class, 'PeriksaKeluar'])->name('periksaKeluar');

    Route::get('/pemeriksaan', [pageController::class, 'Pemeriksaan'])->name('pemeriksaan');

    Route::POST('/periksa/ambil', [OPSController::class, 'Ambil'])->name('OPSambil');

    Route::POST('/periksa/start', [OPSController::class, 'StartPeriksa'])->name('startPeriksa');

    Route::POST('/periksa', [pageController::class, 'Periksa'])->name('periksa');

    Route::POST('/periksa2', [pageController::class, 'Periksa2'])->name('periksa2');

    ROUTE::PATCH('/qcClick', [OPSController::class, 'QCClick'])->name('QCClick');

    ROUTE::PATCH('/banQC', [OPSController::class, 'BanQC'])->name('banQC');

    ROUTE::PATCH('/periksa', [OPSController::class, 'SubmitQC'])->name('SubmitQC');

    Route::post('/bast/input', [OPSController::class, 'InputBAST'])->name('inputBAST');

    Route::POST('/delivered', [OPSController::class, 'Delivered']);

    Route::GET('/repair', [pageController::class, 'Repair'])->name('repair');

    Route::POST('/repair/add', [OPSController::class, 'RepairAdd']);

    Route::POST('/bengkel/selesai', [OPSController::class, 'SelesaiBengkel']);

    Route::POST('/repair/done', [OPSController::class, 'RepairDone']);
});

Route::get('/cekcek', function(){
    return view('checking');
});

Route::get('/cobaUpload', function () {
    return view('cobaUpload');
});

Route::POST('/coba/submit', [JBController::class, 'Cobas']);