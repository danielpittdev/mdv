<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiBase extends Controller
{
	public function index()
	{
		return response()->json(
			MODELO::where('usuario_id', auth()->id())->get()
		);
	}

	public function store(Request $request)
	{
		$validacion = Validator::make($request->all(), [
			'titulo' => 'required|string|max:255',
			'media' => 'sometimes|required|mimes:jpg,jpeg,png|max:5096',
		]);

		if ($validacion->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => 'Fallo de validación',
				'errors' => $validacion->errors()
			], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
		}

		if ($request->hasFile('icono') && $request->file('icono')->isValid()) {
			$datos['icono'] = $request->file('icono')->store('iconos', 'public'); // guarda en storage/app/public/avatars
		}

		$datos = $validacion->validated();
		$variable = MODELO::create($datos);

		return response()->json($variable, 201);
	}

	public function show(string $uuid)
	{
		$item = MODELO::where('uuid', $uuid)
			->where('usuario_id', auth()->id())
			->firstOrFail();

		return response()->json($item);
	}

	public function update(Request $request, string $uuid)
	{
		$item = MODELO::where('uuid', $uuid)
			->where('usuario_id', auth()->id())
			->firstOrFail();

		$validated = $request->validate([
			'titulo' => 'sometimes|required|string|max:255',
			'media' => 'sometimes|required|mimes:jpg,jpeg,png|max:5096',
		]);

		$item->update($validated);

		return response()->json($item);
	}

	public function destroy(string $uuid)
	{
		$item = MODELO::where('uuid', $uuid)
			->where('usuario_id', auth()->id())
			->firstOrFail();

		$item->delete();

		return response()->json(['message' => 'Eliminado']);
	}
}
