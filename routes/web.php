<?php

use App\Http\Controllers\admin\TableroController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\CatalogoClientController;
use App\Http\Controllers\GendersPublicController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\UsuariosController;
use App\Http\Controllers\admin\GenerosController;
use App\Http\Controllers\admin\PlanesController;
use App\Http\Controllers\admin\VideosControllr;
use App\Http\Controllers\PagosPublicController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PlanesClientController;
use App\Http\Controllers\PlanningPageController;
use App\Http\Controllers\StreamingPublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\op\TableroOperadorController;
use App\Http\Controllers\op\ClientesController;
use App\Http\Controllers\op\PagosController;

Route::get('/', function () {
    return view('client.homePage');
});

Route::get('/',[HomePageController::class, 'Home'])->name('client.home');

Route::get('/login', [LoginController::class, 'index'])->name('client.login');
Route::post('/login/session', [LoginController::class, 'iniciar_sesion'])->name('client.iniciar_sesion');
Route::post('/logout', [LoginController::class, 'logout'])->name('client.logout');
Route::get('/genders', [GendersPublicController::class,'Gender'])->name('client.gender');
Route::get('/genero/{id_genero}', [GendersPublicController::class, 'detalleGenero'])->name('genero.detalle');
Route::get('/planning', [PlanningPageController::class, 'planning'])->name('client.planning');

//Ruta de admisntrador
Route::get('/administrador/tablero', [TableroController::class, 'index'])->name('admin.tablero');
Route::get('/administrador/usuarios', [UsuariosController::class, 'index'])->name('admin.usuarios');
Route::get('/administrador/generos', [GenerosController::class, 'index'])->name('admin.generos');
Route::get('/administrador/streaming', [VideosControllr::class, 'index'])->name('admin.streaming');
Route::get('/administrador/planes', [PlanesController::class, 'index'])->name('admin.planes');
Route::get('/administrador/perfil', [PerfilController::class, 'index'])->name('admin.perfil');

//Rutas para editar 
Route::put('/administrador/usuarios/update/{id}', [UsuariosController::class, 'update'])->name('admin.update');
Route::put('/administrador/generos/update/{id}', [GenerosController::class, 'update'])->name('admin.generos.update');
Route::put('/administrador/streaming/update/{id}', [VideosControllr::class, 'update'])->name('admin.streaming.update');
Route::put('/administrador/planes/update/{id}', [PlanesController::class, 'update'])->name('admin.planes.update');
Route::put('/administrador/videos/update/{id}', [VideosControllr::class, 'update_videos'])->name('admin.videos.update');

//Rutas para eliminar
Route::delete('/administrador/usuarios/delete/{id}', [UsuariosController::class, 'destroy'])->name('admin.usuarios.delete');
Route::delete('/administrador/generos/delete/{id}', [GenerosController::class, 'destroy'])->name('admin.generos.delete');
Route::delete('/administrador/streaming/delete/{id}', [VideosControllr::class, 'destroy'])->name('admin.streaming.delete');
Route::delete('/administrador/planes/delete/{id}', [PlanesController::class, 'destroy'])->name('admin.planes.delete');
Route::delete('/administrador/videos/delete/{id}', [VideosControllr::class, 'destroy_videos'])->name('admin.videos.delete');

//Rutas para crear
Route::post('/administrador/usuarios/store', [UsuariosController::class, 'store'])->name('admin.usuarios.store');
Route::post('/administrador/generos/store', [GenerosController::class, 'store'])->name('admin.generos.store');
Route::post('/administrador/streaming/store', [VideosControllr::class, 'store'])->name('admin.streaming.store');
Route::post('/administrador/planes/store', [PlanesController::class, 'store'])->name('admin.planes.store');
Route::post('/administrador/videos/store', [VideosControllr::class, 'store_videos'])->name('admin.videos.store');
Route::put('/administrador/perfil/update/{id}', [PerfilController::class, 'update'])->name('admin.perfil.update');
Route::put('/administrador/perfil/update_password/{id}', [PerfilController::class, 'cambiar_contrasena'])->name('admin.perfil.update_password');

//Rutas para vista del operador
Route::get('/operador/home', [TableroOperadorController::class, 'index'])->name('operador.home');
Route::get('/operador/clientes', [ClientesController::class, 'index'])->name('operador.client');
Route::get('/operador/perfil', [PerfilController::class, 'index_operador'])->name('operador.Perfil');
Route::get('/operador/pagos', [PagosController::class, 'index'])->name('operador.pagos');

//Rutas para editar
Route::put('/operador/clientes/update/{id}', [ClientesController::class, 'update'])->name('operador.client.update');
Route::delete('/operador/clientes/delete/{id}', [ClientesController::class, 'destroy'])->name('operador.client.delete');

//Rutas para crear
Route::post('/operador/clientes/store', [ClientesController::class, 'store'])->name('operador.client.store');
Route::put('/operador/perfil/update/{id}', [PerfilController::class, 'update'])->name('operador.perfil.update');
Route::put('/operador/perfil/update_password/{id}', [PerfilController::class, 'cambiar_contrasena'])->name('operador.perfil.update_password');

//Rutas para pagos
Route::patch('/operador/pagos/update/{id_pago}', [PagosController::class, 'update_pagos'])->name('operador.pagos.update');
Route::delete('/operador/pagos/delete/{id_pago}', [PagosController::class, 'destroy'])->name('operador.pagos.delete');

Route::get('/streaming', [StreamingPublicController::class, 'streaming'])->name('client.streaming');
Route::get('/streaming/{id}', [StreamingPublicController::class, 'detalleStreaming'])->name('client.streaming.show');

// Perfil
Route::get('/perfil', [PerfilController::class, 'perfil'])->name('client.perfil');

// Alquiler
Route::get('/alquiler', [AlquilerController::class, 'encontrarAlquiler'])->name('client.alquiler');
Route::get('/alquiler/{idStreaming}', [AlquilerController::class, 'alquilerElemento'])->name('client.alquiler.streaming');
Route::get('/alquiler/contrato/actuales', [AlquilerController::class, 'encontrarAlquiler'])->name('client.alquiler.info');
Route::post('/alquiler/contrato/cancelar/{idAlquiler}', [AlquilerController::class, 'cancelarAlquiler'])->name('client.alquiler.cancelar');

// Pagos
Route::get('/pagos', [PagosPublicController::class, 'pago'])->name('client.pagos');
Route::get('/pagos/crear', [PagosPublicController::class, 'pago'])->name('client.pagos.create');

Route::post('/planes/crear', [PlanesClientController::class, 'contratar'])->name('client.planes.contrato');

Route::get('/catalogo', [CatalogoClientController::class, 'catalogo'])->name('catalogo');
Route::get('/streaming/{id}', [StreamingPublicController::class, 'detalleStreaming'])->name('cliente.streaming.show');

Route::get('/alquiler/contrato/actuales', [AlquilerController::class, 'encontrarAlquiler'])->name('cliente.alquiler.info');
Route::post('/alquiler/contrato/cancelar/{idAlquiler}', [AlquilerController::class, 'cancelarAlquiler'])->name('cliente.alquiler.cancelar');