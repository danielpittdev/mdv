<?php

namespace App\Http\Controllers\Api;

use App\Models\Iglesia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiIglesia extends Controller
{
	public function index()
	{
		return response()->json(
			Iglesia::where('usuario_id', Auth::user()->id)->get()
		);
	}

	public function store(Request $request)
	{
		$validacion = Validator::make($request->all(), [
			'nombre' => 'required|string|max:255',
			'icono' => 'sometimes|mimes:jpg,jpeg,png|max:5096',
			'direccion' => 'required|string|max:255',
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

		$variable = Iglesia::create($datos);

		return response()->json($variable, 201);
	}

	public function show(string $uuid)
	{
		$item = Iglesia::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		return response()->json($item);
	}

	public function update(Request $request, string $uuid)
	{
		$item = Iglesia::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		$validated = $request->validate([
			'nombre' => 'sometimes|string|max:255',
			'icono' => 'sometimes|mimes:jpg,jpeg,png|max:5096',
			'direccion' => 'sometimes|string|max:255',
		]);

		// Icono
		if ($request->hasFile('icono') && $request->file('icono')->isValid()) {
			$validated['icono'] = $request->file('icono')->store('iconos', 'public');
		}

		$item->update($validated);
		return response()->json($item);
	}

	public function destroy(string $uuid)
	{
		$item = Iglesia::where('uuid', $uuid)
			->where('usuario_id', Auth::user()->id)
			->firstOrFail();

		$item->delete();

		return response()->json(['message' => 'Eliminado']);
	}
}
