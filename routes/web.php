<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SingleController;

Route::get('/', [WebController::class, 'inicio'])->name('inicio');

// AUTH Vistas
Route::get('/login', [WebController::class, 'login'])->name('login');
Route::get('/registro', [WebController::class, 'registro'])->name('registro');
Route::get('/recuperar', [WebController::class, 'recuperacion'])->name('recuperacion');
Route::get('/resetear/{id}', [WebController::class, 'resetear'])->name('resetear');
// AUTH POSTs
Route::post('/login', [AuthController::class, 'post_login'])->name('post_login');
Route::post('/registro', [AuthController::class, 'post_registro'])->name('post_registro');
Route::post('/recuperar', [AuthController::class, 'post_recuperacion'])->name('post_recuperacion');
Route::post('/resetear', [AuthController::class, 'post_resetear'])->name('post_resetear');

# Rutas de PANEL
Route::prefix('panel')->middleware('auth:web')->group(function () {
	Route::get('/', [PanelController::class, 'inicio'])->name('panel');
	//
	Route::get('/iglesias', [PanelController::class, 'iglesias'])->name('panel_iglesias');
	Route::get('/personas', [PanelController::class, 'personas'])->name('panel_personas');
	Route::get('/grupos', [PanelController::class, 'grupos'])->name('panel_grupos');
	Route::get('/seguimientos', [PanelController::class, 'seguimientos'])->name('panel_seguimientos');
	Route::get('/servidores', [PanelController::class, 'servidores'])->name('panel_servidores');
	//
	Route::get('/ajustes', [PanelController::class, 'ajustes'])->name('panel_ajustes');
});

# Rutas de PANEL (Individuales)
Route::prefix('panel/single')->middleware('auth:web')->group(function () {
	Route::get('iglesia/{id}', [SingleController::class, 'iglesia'])->name('panel_iglesia_single');
	Route::get('persona/{id}', [SingleController::class, 'persona'])->name('panel_persona_single');
	Route::get('grupo/{id}', [SingleController::class, 'grupo'])->name('panel_grupo_single');
	Route::get('seguimiento/{id}', [SingleController::class, 'seguimiento'])->name('panel_seguimiento_single');
	Route::get('servidor/{id}', [SingleController::class, 'servidor'])->name('panel_servidor_single');
});
