@extends('general.html.auth')

@section('contenido')
	<div class="flex min-h-full flex-col justify-center items-center py-12 sm:px-6 lg:px-8 mx-auto max-w-xl">
		<div class="sm:mx-auto">
			<img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
			<h2 class="mt-6 text-center text-2xl/9 font-semibold tracking-tight">Iniciar sesión</h2>
		</div>

		<div class="mt-0 sm:mx-auto w-full">
			<div class="px-6 py-10 sm:rounded-lg sm:px-12">
				<form class="space-y-6" id="login" action="{{ route('login') }}" method="post">
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

					<div>
						<label for="text" class="block text-sm/6 font-medium">Correo electrónico</label>
						<div class="mt-2">
							<input type="text" name="correo" id="correo" autocomplete="correo" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
						</div>
					</div>

					<div>
						<label for="password" class="block text-sm/6 font-medium">Contraseña</label>
						<div class="mt-2">
							<input type="password" name="password" id="password" autocomplete="current-password" class="block w-full rounded-md bg-base-200 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-base-300 placeholder:text-base-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
						</div>
					</div>

					<div class="flex items-center justify-between">
						<div class="flex gap-3">
							<div class="flex h-6 shrink-0 items-center">
								<div class="group grid size-4 grid-cols-1">
									<input id="remember-me" name="remember-me" type="checkbox" class="col-start-1 row-start-1 appearance-none rounded-sm border border-base-200 bg-base-300 checked:border-indigo-600 checked:bg-base-600 indeterminate:border-indigo-600 indeterminate:bg-base-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-base-100 disabled:bg-base-100 disabled:checked:bg-base-100 forced-colors:appearance-auto" />
									<svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-base-950/25" viewBox="0 0 14 14" fill="none">
										<path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</div>
							</div>
							<label for="remember-me" class="block text-sm/6">Recordarme</label>
						</div>

						<div class="text-sm/6">
							<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">¿Contraseña olvidada?</a>
						</div>
					</div>

					<div>
						<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Iniciar sesión</button>
					</div>
				</form>
			</div>

			<p class="mt-10 text-center text-sm/6 text-base-500">
				¿No eres miembro?
				<a href="{{ route('registro') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Regístrarse</a>
			</p>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		const formulario = document.querySelector('#login');
		if (formulario) {
			formulario.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario)
					.then(data => {
						console.log(data)
						if (data.redirect) {
							window.location.href = data.redirect;
						}
					})
			});
		}
	</script>
@endsection
