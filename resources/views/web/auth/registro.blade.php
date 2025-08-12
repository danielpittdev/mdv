@extends('general.html.auth')

@section('contenido')
	<div class="flex min-h-full flex-col justify-center items-center py-12 sm:px-6 lg:px-8">
		<div class="mt-7 w-full lg:max-w-xl space-y-10 px-3">

			<div class="sm:mx-auto">
				<img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
				<h2 class="mt-6 text-center text-2xl/9 font-semibold tracking-tight">Regístrate</h2>
			</div>

			<!-- Formulario -->
			<div class="bg-base-100 px-6 py-4 shadow-sm sm:rounded-lg sm:px-12">
				<form id="registro" action="{{ route('registro') }}" method="post">
					@csrf
					<div class="alerta rounded-md bg-red-500/30 text-white p-4 transition-all duration-500 transform opacity-0 pointer-events-none hidden">
						<div class="flex">
							<div class="shrink-0">
								<svg class="size-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
								</svg>
							</div>
							<div class="ml-3">
								<h3 class="text-sm font-medium error_mensaje"></h3>
								<div class="mt-2 text-sm">
									<ul role="list" class="list-disc space-y-1 pl-5 error_lista"></ul>
								</div>
							</div>
						</div>
					</div>

					<!--PARTE IZQUIERDA-->
					<div class="grid grid-cols-2 gap-4">
						<div class="col-span-2">
							<label for="nombre" class="block text-sm/6 font-medium">Nombre*</label>
							<div class="mt-2">
								<input type="nombre" name="nombre" id="nombre" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="lg:col-span-1 col-span-2">
							<label for="apellido_1" class="block text-sm/6 font-medium">Primer apellido*</label>
							<div class="mt-2">
								<input type="apellido_1" name="apellido_1" id="apellido_1" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="lg:col-span-1 col-span-2">
							<label for="apellido_2" class="block text-sm/6 font-medium">Segundo apellido*</label>
							<div class="mt-2">
								<input type="apellido_2" name="apellido_2" id="apellido_2" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="col-span-2">
							<label for="nombre_usuario" class="block text-sm/6 font-medium">Nombre de usuario*</label>
							<div class="mt-2">
								<input type="nombre_usuario" name="nombre_usuario" id="nombre_usuario" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="col-span-2">
							<label for="correo" class="block text-sm/6 font-medium">Correo electrónico*</label>
							<div class="mt-2">
								<input type="correo" name="correo" id="correo" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="lg:col-span-1 col-span-2">
							<label for="password" class="block text-sm/6 font-medium">Contraseña*</label>
							<div class="mt-2">
								<input type="password" name="password" id="password" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="lg:col-span-1 col-span-2">
							<label for="password_confirmation" class="block text-sm/6 font-medium">Confirmar contraseña*</label>
							<div class="mt-2">
								<input type="password" name="password_confirmation" id="password_confirmation" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="col-span-2 mt-5">
							<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrarse</button>
						</div>
					</div>


				</form>
			</div>

			<p class="mt-10 text-center text-sm/6 text-base-500">
				¿Ya eres miembro?
				<a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Iniciar sesión</a>
			</p>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		const formulario = document.querySelector('#registro');
		if (formulario) {
			formulario.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario)
					.then(data => {
						console.log('Datos recibidos:', data);
						if (data.redirect) {
							window.location.href = data.redirect;
						}
					})
			});
		}
	</script>
@endsection
