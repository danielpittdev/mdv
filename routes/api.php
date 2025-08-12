<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiGrupo;
use App\Http\Controllers\Api\ApiIglesia;
use App\Http\Controllers\Api\ApiPersona;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiServidor;
use App\Http\Controllers\Api\ApiSeguimiento;

Route::prefix('auth')->group(function () {
	Route::post('/login', [AuthController::class, 'post_login']);
	Route::post('/registro', [AuthController::class, 'post_registro']);
	Route::post('/actualizar', [AuthController::class, 'actualizar_usuario'])->name('actualizar_usuario');
});

# Rutas de PANEL
Route::prefix('v1')->middleware('auth:api')->group(function () {
	Route::apiResource('grupo', ApiGrupo::class)->names('grupo');
	Route::apiResource('iglesia', ApiIglesia::class)->names('iglesia');
	Route::apiResource('persona', ApiPersona::class)->names('persona');
	Route::apiResource('seguimiento', ApiSeguimiento::class)->names('seguimiento');
	Route::apiResource('servidor', ApiServidor::class)->names('servidor');
});
