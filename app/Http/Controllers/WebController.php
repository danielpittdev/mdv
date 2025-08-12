<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{

	public function inicio() //OK
	{
		return view('inicio');
	}

	// Rutas de Auth
	public function login() //OK
	{
		return view('web.auth.login');
	}

	# Registro
	public function registro() //OK
	{
		return view('web.auth.registro');
	}

	# Recuperación contraseña
	public function recuperacion()
	{
		return view('web.auth.recuperacion');
	}

	# Resetar
	public function resetear($id)
	{
		return view('web.auth.resetar');
	}
}
