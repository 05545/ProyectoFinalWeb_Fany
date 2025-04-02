<?php

use App\Http\Controllers\admin\TableroController;
use App\Http\Controllers\GendersPublicController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.homePage');
});

Route::get('/login', [LoginController::class, 'index'])->name('client.login');
Route::post('/login', [LoginController::class, 'iniciar_sesion'])->name('client.iniciar_sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('client.logout');
Route::get('/genders', [GendersPublicController::class,'Gender'])->name('client.gender');


//Ruta de admisntrador
Route::get('/administrador/tablero', [TableroController::class, 'index'])->name('admin.tablero');
