<?php

namespace App\Http\Controllers\Api;

use App\Models\Grupo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiGrupo extends Controller
{
	public function index()
	{
		return response()->json(
			Grupo::where('usuario_id', Auth::user()->id)->get()
		);
	}

	public function store(Request $request)
	{
		$validacion = Validator::make($request->all(), [
			'nombre' => 'required|string|max:255',
			'descripcion' => 'required|string|max:1000',
			'icono' => 'nullable|mimes:jpg,jpeg,png|max:5096',
			'iglesia_id' => 'required|integer|exists:iglesias,id',
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

		$variable = Grupo::create($datos);

		return response()->json($variable, 201);
	}

	public function show(string $uuid)
	{
		$item = Grupo::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		return response()->json($item);
	}

	public function update(Request $request, string $uuid)
	{
		$item = Grupo::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		$validated = Validator::make($request->all(), [
			'nombre' => 'sometimes|string|max:255',
			'descripcion' => 'sometimes|string|max:1000',
			'icono' => 'sometimes|mimes:jpg,jpeg,png|max:5096',
			'iglesia_id' => 'sometimes|integer|exists:iglesias,id',
		]);

		$datos = $validated->validated();

		$item->update($datos);
		return response()->json($item);
	}

	public function destroy(string $uuid)
	{
		$item = Grupo::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		$item->delete();

		return response()->json(['message' => 'Eliminado']);
	}
}
