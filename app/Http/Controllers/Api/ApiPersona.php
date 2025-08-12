<?php

namespace App\Http\Controllers\Api;

use App\Models\Persona;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiPersona extends Controller
{
	public function index()
	{
		return response()->json(
			Persona::all()
		);
	}

	public function store(Request $request)
	{
		$validacion = Validator::make($request->all(), [
			'iglesia_id' => 'required|exists:iglesias,id',
			'nombre' => 'required|string|max:255',
			'apellido_1' => 'required|string|max:255',
			'apellido_2' => 'nullable|string|max:255',
			'telefono' => 'required|string|max:255',
			'correo' => 'required|string|max:255',
			'avatar' => 'sometimes|mimes:jpg,jpeg,png|max:5096',
		]);

		if ($validacion->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => 'Fallo de validación',
				'errors' => $validacion->errors()
			], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
		}

		$datos = $validacion->validated();

		// Icono
		if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
			$datos['avatar'] = $request->file('avatar')->store('avatars', 'public'); // guarda en storage/app/public/avatars
		}

		$variable = Persona::create($datos);

		return response()->json($variable, 201);
	}

	public function show(string $uuid)
	{
		$item = Persona::where('uuid', $uuid)
			->firstOrFail();

		return response()->json($item);
	}

	public function update(Request $request, string $uuid)
	{
		$item = Persona::where('uuid', $uuid)
			->firstOrFail();

		$validated = $request->validate([
			'nombre' => 'sometimes|string|max:255',
			'apellido_1' => 'sometimes|string|max:255',
			'apellido_2' => 'nullable|string|max:255',
			'telefono' => 'sometimes|string|max:255',
			'correo' => 'sometimes|string|max:255',
			'avatar' => 'sometimes|mimes:jpg,jpeg,png|max:5096',
		]);

		// Icono
		if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
			$validated['avatar'] = $request->file('avatar')->store('avatars', 'public'); // guarda en storage/app/public/avatars
		}

		$item->update($validated);
		return response()->json($item);
	}

	public function destroy(string $uuid)
	{
		$item = Persona::where('uuid', $uuid)
			->where('iglesia_id', Auth::user()->id)
			->firstOrFail();

		$item->delete();

		return response()->json(['message' => 'Eliminado']);
	}
}
