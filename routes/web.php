<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\PeriodeController;


Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [LoginController::class, 'index']
)->name('login');


Route::post(
    '/login',
    [LoginController::class, 'login']
)->name('login.proses');


Route::post(
    '/logout',
    [LoginController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| LUPA PASSWORD
|--------------------------------------------------------------------------
*/

Route::get(
    '/lupa-password',
    [LupaPasswordController::class, 'index']
)->name('password.request');


Route::post(
    '/lupa-password',
    [LupaPasswordController::class, 'kirim']
)->name('password.email');


Route::get(
    '/reset-password/{token}',
    [LupaPasswordController::class, 'formReset']
)->name('password.reset');


Route::post(
    '/reset-password',
    [LupaPasswordController::class, 'reset']
)->name('password.update');


/*
|--------------------------------------------------------------------------
| HALAMAN SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DATA KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/karyawan',
        [KaryawanController::class, 'index']
    )->name('karyawan.index');


    Route::get(
        '/karyawan/tambah',
        [KaryawanController::class, 'create']
    )->name('karyawan.create');


    Route::post(
        '/karyawan',
        [KaryawanController::class, 'store']
    )->name('karyawan.store');


    Route::get(
        '/karyawan/{id}/edit',
        [KaryawanController::class, 'edit']
    )->name('karyawan.edit');


    Route::put(
        '/karyawan/{id}',
        [KaryawanController::class, 'update']
    )->name('karyawan.update');


    Route::delete(
        '/karyawan/{id}',
        [KaryawanController::class, 'destroy']
    )->name('karyawan.destroy');


    /*
    |--------------------------------------------------------------------------
    | DATA PERIODE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/periode',
        [PeriodeController::class, 'index']
    )->name('periode.index');


    Route::post(
        '/periode',
        [PeriodeController::class, 'store']
    )->name('periode.store');


    Route::patch(
        '/periode/{id}/aktif',
        [PeriodeController::class, 'aktif']
    )->name('periode.aktif');


    Route::delete(
        '/periode/{id}',
        [PeriodeController::class, 'destroy']
    )->name('periode.destroy');

    Route::patch(
    '/periode/{id}/aktif',
    [PeriodeController::class, 'aktif']
)->name('periode.aktif');

Route::patch(
    '/periode/{id}/nonaktif',
    [PeriodeController::class, 'nonaktif']
)->name('periode.nonaktif');

Route::delete(
    '/periode/{id}',
    [PeriodeController::class, 'destroy']
)->name('periode.destroy');


    /*
    |--------------------------------------------------------------------------
    | PENGGAJIAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/penggajian',
        [PenggajianController::class, 'index']
    )->name('penggajian.index');


    Route::get(
        '/penggajian/tambah',
        [PenggajianController::class, 'create']
    )->name('penggajian.create');


    Route::post(
        '/penggajian',
        [PenggajianController::class, 'store']
    )->name('penggajian.store');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/riwayat-penggajian',
        [PenggajianController::class, 'riwayat']
    )->name('riwayat.index');


    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/penggajian/{id}/pdf',
        [PenggajianController::class, 'pdf']
    )->name('penggajian.pdf');


    /*
    |--------------------------------------------------------------------------
    | EMAIL
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/penggajian/{id}/email',
        [PenggajianController::class, 'email']
    )->name('penggajian.email');


    /*
    |--------------------------------------------------------------------------
    | WHATSAPP FONNTE
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/penggajian/{id}/whatsapp',
        [PenggajianController::class, 'whatsapp']
    )->name('penggajian.whatsapp');

});