<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Grupo;
use App\Models\Cliente;
use App\Models\Iglesia;
use App\Models\Persona;
use App\Models\Proyecto;
use App\Models\Servidor;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Process;
use Illuminate\Validation\ValidationException;

class PanelController extends Controller
{
	# Inicio
	public function inicio() //OK
	{
		$recordatorios = Seguimiento::whereDate('fecha_recordar', today())->get()
			->sortBy(fn($s) => ['alta' => 1, 'media' => 2, 'baja' => 3][$s->prioridad] ?? 99)
			->values();
		return view('panel.inicio', compact('recordatorios'));
	}

	public function iglesias() //OK
	{
		$iglesias = Iglesia::all();
		return view('panel.iglesias', compact('iglesias'));
	}

	public function personas() //OK
	{
		$personas = Persona::all();
		return view('panel.personas', compact('personas'));
	}

	public function grupos() //OK
	{
		$grupos = Auth::user()->grupos;
		$iglesias = Auth::user()->iglesias;
		return view('panel.grupos', compact('grupos', 'iglesias'));
	}

	public function seguimientos() //OK
	{
		$seguimientos = Seguimiento::all();
		$personas = Persona::whereIn('iglesia_id', Auth::user()->iglesias()->pluck('id'))->get();
		return view('panel.seguimientos', compact('seguimientos', 'personas'));
	}

	public function servidores() //OK
	{
		$servidores = Servidor::all();
		return view('panel.servidores', compact('servidores'));
	}

	# Ajustes
	public function ajustes() //OK
	{
		return view('panel.ajustes');
	}
}
