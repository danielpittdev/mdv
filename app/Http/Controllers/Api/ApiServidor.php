<?php

namespace App\Http\Controllers\Api;

use App\Models\Grupo;
use App\Models\Servidor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiServidor extends Controller
{
	public function index()
	{
		return response()->json(
			Servidor::where('usuario_id', Auth::user()->id)->get()
		);
	}

	public function store(Request $request)
	{
		$validacion = Validator::make($request->all(), [
			'grupo_id' => 'required|integer|exists:grupos,id',
			'persona_id' => 'required|integer|exists:personas,id',
			'rol' => 'required|string',
		]);

		if ($validacion->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => 'Fallo de validación',
				'errors' => $validacion->errors()
			], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
		}

		$datos = $validacion->validated();

		// ✅ Aquí validamos si el grupo pertenece a una iglesia del usuario
		$grupo = Grupo::with('iglesia')->find($datos['grupo_id']);

		if (!$grupo || $grupo->iglesia->usuario_id !== Auth::id()) {
			return response()->json([
				'status' => 'error',
				'message' => 'No tienes permiso para usar este grupo',
			], JsonResponse::HTTP_FORBIDDEN);
		}

		if (Servidor::where('grupo_id', $datos['grupo_id'])
			->where('persona_id', $datos['persona_id'])
			->exists()
		) {
			return response()->json([
				'status' => 'error',
				'message' => 'Ya existe un registro con este grupo y persona',
			], JsonResponse::HTTP_CONFLICT);
		}

		$datos['usuario_id'] = Auth::id();

		// Icono
		if ($request->hasFile('icono') && $request->file('icono')->isValid()) {
			$datos['icono'] = $request->file('icono')->store('iconos', 'public');
		}

		$servidor = Servidor::create($datos);

		return response()->json($servidor, 201);
	}

	public function show(string $uuid)
	{
		$item = Servidor::where('uuid', $uuid)
			->firstOrFail();

		return response()->json($item->load('persona'));
	}

	public function update(Request $request, string $uuid)
	{
		$item = Servidor::where('uuid', $uuid)
			->firstOrFail();

		$validated = $request->validate([
			'grupo_id' => 'sometimes|integer|exists:grupos,id',
			'persona_id' => 'sometimes|integer|exists:personas,id',
			'rol' => 'sometimes|string',
		]);

		$item->update($validated);
		return response()->json($item);
	}

	public function destroy(string $uuid)
	{
		$item = Servidor::where('uuid', $uuid)
			->firstOrFail();

		$item->delete();

		return response()->json(['message' => 'Eliminado']);
	}
}
