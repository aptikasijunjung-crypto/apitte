<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\{DashboardController, LoginController, NikController};
use App\Http\Controllers\{PengaturanController, TestController};

Route::get('/', function () {
    return view('welcome');
});


Route::controller(TestController::class)->group(function () {
    Route::get('/tte', 'index')->name('tte.index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'store')->name('backend.login');
});

Route::middleware('auth:admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/home', 'index')->name('dashboard');
        Route::get('/user/create/{slug}', 'create')->name('dashboard.create');
        Route::post('/user/store', 'store')->name('dashboard.store');
        Route::post('/user/modald', 'modald')->name('dashboard.modald');
        Route::post('/user/delete', 'delete')->name('dashboard.delete');
    });
    Route::controller(NikController::class)->group(function () {
        Route::get('/nik/index/{slug}', 'index')->name('nik.index');
        Route::get('/nik/create/{slug}', 'create')->name('nik.create');
        Route::post('/nik/store', 'store')->name('nik.store');
        Route::post('/nik/modald', 'modald')->name('nik.modald');
        Route::post('/nik/delete', 'delete')->name('nik.delete');
    });
    Route::controller(PengaturanController::class)->group(function () {
        Route::get('/pengaturan', 'index')->name('setting.index');
        Route::post('/pengaturan', 'store')->name('setting.store');
    });
});
