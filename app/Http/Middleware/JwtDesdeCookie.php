<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtDesdeCookie
{
	public function handle(Request $request, Closure $next): Response
	{
		// Si la cookie 'jwt_token' existe y no hay ya una cabecera de autorización...
		if ($request->hasCookie('jwt_token') && !$request->bearerToken()) {
			$token = $request->cookie('jwt_token');
			// ...la ponemos en la cabecera para que Laravel la entienda.
			$request->headers->set('Authorization', 'Bearer ' . $token);
		}

		return $next($request);
	}
}
