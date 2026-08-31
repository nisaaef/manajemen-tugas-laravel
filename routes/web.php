<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('isLogin')->group(function(){
        //Login
        Route::get('login',[AuthController::class, 'login'])->name('login');
        Route::post('login',[AuthController::class, 'loginProses'])->name('loginProses');
});


Route::middleware('checkLogin')->group(function(){
    
    //Dashboard
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    //Tugas
    Route::get('tugas',[TugasController::class, 'index'])->name('tugas');
    Route::get('/tugas/pdf', [TugasController::class, 'exportPDF'])->name('tugas.pdf');
});

Route::middleware('isAdmin')->group(function(){
    //User
    Route::get('user/admin', [UserController::class, 'admin'])->name('user.admin');
    Route::get('user/karyawan', [UserController::class, 'karyawan'])->name('user.karyawan');
    Route::get('user/ditugaskan', [UserController::class, 'ditugaskan'])->name('user.ditugaskan');
    Route::get('user/belumtugas', [UserController::class, 'belumtugas'])->name('user.belumtugas');
    Route::get('user',[UserController::class, 'index'])->name('user');
    Route::get('user/create',[UserController::class, 'create'])->name('userCreate');
    Route::post('user/store',[UserController::class, 'store'])->name('userStore');
    Route::get('user/edit/{id}',[UserController::class, 'edit'])->name('userEdit');
    Route::post('user/update/{id}',[UserController::class, 'update'])->name('userUpdate');
    Route::delete('user/destroy/{id}',[UserController::class, 'destroy'])->name('userDestroy');
    Route::get('/user/export', [UserController::class, 'exportExcel'])->name('userExport');
    Route::get('/user/pdf', [UserController::class, 'exportPdf'])->name('user.pdf');
   
    //Tugas
    
    Route::get('tugas/create',[TugasController::class, 'create'])->name('tugasCreate');
    Route::post('tugas/store',[TugasController::class, 'store'])->name('tugasStore');
    Route::get('tugas/edit/{id}',[TugasController::class, 'edit'])->name('tugasEdit');
    Route::post('tugas/update/{id}',[TugasController::class, 'update'])->name('tugasUpdate');
    Route::delete('tugas/destroy/{id}',[TugasController::class, 'destroy'])->name('tugasDestroy');
    Route::get('/tugas/export', [TugasController::class, 'exportExcel'])->name('tugas.export');
    
});

//Logout
Route::get('logout',[AuthController::class, 'logout'])->name('logout');

