<?php

namespace App\Http\Controllers\Api;

use App\Models\Seguimiento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiSeguimiento extends Controller
{
	public function index()
	{
		return response()->json(
			Seguimiento::where('usuario_id', Auth::user()->id)->get()
		);
	}

	public function store(Request $request)
	{
		$validacion = Validator::make($request->all(), [
			'titulo' => 'required|string|max:255',
			'descripcion' => 'required|string',
			'estado_emocional' => 'required|string|max:255',
			'fecha_recordar' => 'nullable|date',
			'prioridad' => 'required|string',
			'persona_id' => 'required|integer|exists:personas,id',
		]);

		if ($validacion->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => 'Fallo de validación',
				'errors' => $validacion->errors()
			], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
		}

		$datos = $validacion->validated();
		$datos['usuario_id'] = Auth::user()->id;

		// Icono
		if ($request->hasFile('icono') && $request->file('icono')->isValid()) {
			$datos['icono'] = $request->file('icono')->store('iconos', 'public'); // guarda en storage/app/public/avatars
		}

		$variable = Seguimiento::create($datos);

		return response()->json($variable, 201);
	}

	public function show(string $uuid)
	{
		$item = Seguimiento::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		return response()->json($item);
	}

	public function update(Request $request, string $uuid)
	{
		$item = Seguimiento::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		$validated = $request->validate([
			'titulo' => 'sometimes|string|max:255',
			'descripcion' => 'sometimes|string',
			'estado_emocional' => 'sometimes|string|max:255',
			'fecha_recordar' => 'sometimes|date',
			'prioridad' => 'sometimes|string',
			'persona_id' => 'sometimes|integer|exists:personas,id',
		]);

		$item->update($validated);
		return response()->json($item);
	}

	public function destroy(string $uuid)
	{
		$item = Seguimiento::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		$item->delete();

		return response()->json(['message' => 'Eliminado']);
	}
}
