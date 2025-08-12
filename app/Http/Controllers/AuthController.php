<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

# Modelos
use App\Models\Usuario;

class AuthController extends Controller
{
	public function post_login(Request $request)
	{
		// 1. Validación
		$validator = Validator::make($request->all(), [
			'correo'   => 'required|email',
			'password' => 'required|string|min:6',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Datos inválidos',
				'errors'  => $validator->errors(),
			], 422);
		}

		// 2. Intentar login
		$credenciales = [
			'correo'   => $request->correo,
			'password' => $request->password,
		];

		// 2. Autenticación vía JWT (guard api)
		if ($token = auth('api')->attempt($credenciales)) {
			// También loguea al usuario en sesión web si lo necesitas

			if (!$request->api || $request->api == null) {
				Auth::attempt($credenciales, $request->remember === 'on');
				$request->session()->regenerate();
			}

			// Duración del token en minutos
			$minutes = auth('api')->factory()->getTTL();

			// Crea la cookie para funcionar en local con IP
			$cookie = cookie(
				'jwt_token',
				$token,
				$minutes,
				'/',
				null,
				false,
				true,
				false,
				'Lax'
			);

			// Devuelve la respuesta JSON y adjunta la cookie segura.
			return response()->json([
				'message'       => 'Login exitoso',
				'redirect'      => route('panel'),
				'token' => $token
			])->withCookie($cookie);
		}

		// 3. Fallo de login
		return response()->json([
			'message' => 'Credenciales incorrectas, comprueba los datos.',
		], 401);
	}

	public function post_registro(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nombre'     => 'required|string|max:255',
			'apellido_1'     => 'required|string|max:255',
			'apellido_2'     => 'required|string|max:255',
			'nombre_usuario'     => 'required|string|max:20',
			'avatar'     => 'nullable|mimes:jpg,png,jpeg|max:5096',
			'correo'     => 'required|email|unique:usuarios,correo',
			'password'   => 'required|string|min:6|confirmed',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Comprueba los campos',
				'errors' => $validator->errors(),
			], 422);
		}

		$avatar = null;

		if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
			$avatar = $request->file('avatar')->store('avatars', 'public'); // guarda en storage/app/public/avatars
		}

		$usuario = Usuario::create([
			'nombre'   => ucfirst($request->nombre),
			'apellido_1'   => ucfirst($request->apellido_1),
			'apellido_2'   => ucfirst($request->apellido_2),
			'nombre_usuario'   => $request->nombre_usuario,
			'avatar'   => $avatar,
			'correo'   => $request->correo,
			'password' => Hash::make($request->password),
		]);

		Auth::login($usuario);

		return response()->json([
			'message' => 'Registro exitoso',
			'redirect' => route('panel')
		]);
	}

	public function post_recuperacion(Request $request)
	{
		$request->validate(['correo' => 'required|email']);

		$status = Password::sendResetLink(['email' => $request->correo]);

		if ($status === Password::RESET_LINK_SENT) {
			return response()->json([
				'message' => __($status)
			]);
		}

		return response()->json([
			'mensaje' => __($status),
		], 400);
	}

	public function post_resetear(Request $request)
	{
		$request->validate([
			'token' => 'required',
			'correo' => 'required|email',
			'password' => 'required|string|min:6|confirmed',
		]);

		$status = Password::reset(
			[
				'email' => $request->correo,
				'password' => $request->password,
				'password_confirmation' => $request->password_confirmation,
				'token' => $request->token,
			],
			function ($user, $password) {
				$user->forceFill([
					'password' => Hash::make($password),
					'remember_token' => Str::random(60),
				])->save();
			}
		);

		if ($status === Password::PASSWORD_RESET) {
			return response()->json([
				'message' => 'Contraseña actualizada correctamente',
				'redirect' => route('login')
			]);
		}

		return response()->json([
			'mensaje' => __($status),
		], 400);
	}

	public function actualizar_usuario(Request $request)
	{
		$usuario = auth('api')->user(); // usar el modelo, no el ID

		$validator = Validator::make($request->all(), [
			'nombre'           => 'sometimes|required|string|max:255',
			'apellido_1'       => 'sometimes|required|string|max:255',
			'apellido_2'       => 'sometimes|required|string|max:255',
			'nombre_usuario'   => 'nullable|string|max:20',
			'correo'           => 'nullable|email|unique:usuarios,correo,' . $usuario->id,
			'avatar'           => 'nullable|file|mimes:jpg,png,jpeg|max:5096',
			'password_actual'  => 'nullable|required_with:password|string',
			'password'         => 'nullable|string|min:6|confirmed',
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'Comprueba los campos',
				'errors'  => $validator->errors(),
			], 422);
		}

		$data = $request->only([
			'nombre',
			'apellido_1',
			'apellido_2',
			'nombre_usuario',
			'correo'
		]);

		// Avatar
		if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
			$data['avatar'] = $request->file('avatar')->store('avatars', 'public');
		}

		// Contraseña
		if ($request->filled('password_actual') && $request->filled('password')) {
			if (!Hash::check($request->password_actual, $usuario->password)) {
				return response()->json(['message' => 'La contraseña actual no es válida.'], 401);
			}
			$data['password'] = Hash::make($request->password);
		}

		foreach (['nombre', 'apellido_1', 'apellido_2'] as $campo) {
			if (isset($data[$campo])) {
				$data[$campo] = ucfirst($data[$campo]);
			}
		}

		$usuario->update($data);

		return response()->json([
			'message' => 'Perfil actualizado correctamente',
			'usuario' => $usuario
		]);
	}
}
