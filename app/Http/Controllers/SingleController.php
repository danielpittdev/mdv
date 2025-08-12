<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Cliente;
use App\Models\Iglesia;
use App\Models\Persona;
use App\Models\Servidor;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleController extends Controller
{
	# iglesia
	public function iglesia($id) //OK
	{
		$iglesia = Iglesia::whereUuid($id)->first();
		return view('panel.single.iglesia', compact('iglesia'));
	}

	public function persona($id) //OK
	{
		$persona = Persona::whereUuid($id)->first();
		return view('panel.single.persona', compact('persona'));
	}

	public function grupo($id) //OK
	{
		$grupo = Grupo::with('servidores.persona')->whereUuid($id)->firstOrFail();
		return view('panel.single.grupo', compact('grupo'));
	}

	public function seguimiento($id) //OK
	{
		$seguimiento = Seguimiento::whereUuid($id)->first();
		$persona = $seguimiento->persona->load('seguimientos');

		// Agrupar por fecha (YYYY-mm-dd)
		$seguimientosAgrupados = $persona->seguimientos
			->groupBy(fn($s) => $s->created_at->toDateString());

		return view('panel.single.seguimiento', compact('seguimiento', 'persona', 'seguimientosAgrupados'));
	}

	public function servidor($id) //OK
	{
		$servidor = Servidor::whereUuid($id)->first();
		return view('panel.single.servidor', compact('servidor'));
	}
}
