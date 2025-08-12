@extends('general.html.panel')

@section('contenido')
	<div class="space-y-20">
		<form action="{{ route('actualizar_usuario') }}" id="actualizar_usuario" method="post" class="max-w-xl">
			@csrf
			<!-- ALERTA -->
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

			<div class="space-y-12">
				<section>
					<h2 class="text-base/7 font-semibold">Ajustes del usuario</h2>
					<p class="mt-1 text-sm/6 text-base-content/50">Cambia tu información de usuario.</p>

					<div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
						<div class="col-span-full">
							<fieldset>
								<div class="img-group">
									<label for="avatar">
										<img src="{{ Storage::url(auth()->user()->avatar ?? 'icons/avatar.png') }}" class="preview size-20 p-0 hover:p-[1px] duration-200 rounded-full object-cover input cursor-pointer">
									</label>
									<input autocomplete="off" type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
								</div>
							</fieldset>
						</div>

						<div class="sm:col-span-4">
							<fieldset>
								<div class="sm:col-span-4">
									<label for="nombre_usuario" class="block text-sm/6 font-medium">Nombre de usuario</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="nombre_usuario" id="nombre_usuario" value="{{ auth()->user()->nombre_usuario }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</div>
							</fieldset>
						</div>
					</div>
				</section>

				<section>
					<h2 class="text-base/7 font-semibold">Información personal</h2>
					<p class="mt-1 text-sm/6 text-base-content/50">Usa una dirección permanente donde puedas recibir correo.</p>

					<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
						<div class="sm:col-span-4">
							<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
							<div class="mt-2">
								<input autocomplete="off" value="{{ auth()->user()->nombre }}" type="text" name="nombre" id="nombre" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="sm:col-span-3">
							<label for="apellido_1" class="block text-sm/6 font-medium">Primer apellido</label>
							<div class="mt-2">
								<input autocomplete="off" value="{{ auth()->user()->apellido_1 }}" type="text" name="apellido_1" id="apellido_1" autocomplete="family-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="sm:col-span-3">
							<label for="apellido_2" class="block text-sm/6 font-medium">Segundo apellido</label>
							<div class="mt-2">
								<input autocomplete="off" value="{{ auth()->user()->apellido_2 }}" type="text" name="apellido_2" id="apellido_2" autocomplete="family-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="sm:col-span-4">
							<label for="correo" class="block text-sm/6 font-medium">Correo electrónico</label>
							<div class="mt-2">
								<input autocomplete="off" value="{{ auth()->user()->correo }}" id="correo" name="correo" type="email" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>
					</div>
				</section>
			</div>

			<div class="mt-10 flex items-center justify-start gap-x-6">
				<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>
			</div>
		</form>

		<form action="{{ route('actualizar_usuario') }}" id="actualizar_password" method="post" class="max-w-sm">
			@csrf
			<!-- ALERTA -->
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
			<div class="space-y-12">
				<div class="">
					<h2 class="text-base/7 font-semibold">Cambiar contraseña</h2>
					<p class="mt-1 text-sm/6 text-base-content/50">Cambia tu contraseña de usuario.</p>

					<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
						<div class="sm:col-span-6">
							<label for="password_actual" class="block text-sm/6 font-medium">Contraseña actual</label>
							<div class="mt-2">
								<input autocomplete="off" type="password" name="password_actual" id="password_actual" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="sm:col-span-3">
							<label for="password" class="block text-sm/6 font-medium">Nueva contraseña</label>
							<div class="mt-2">
								<input autocomplete="off" type="password" name="password" id="password" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>

						<div class="sm:col-span-3">
							<label for="password_confirmation" class="block text-sm/6 font-medium">Repetir contraseña</label>
							<div class="mt-2">
								<input autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mt-10 flex items-center justify-start gap-x-6">
				<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>
			</div>
		</form>
	</div>
@endsection

@section('scripts')
	<script>
		const formulario = document.querySelector('#actualizar_usuario');
		if (formulario) {
			formulario.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(formulario)
					.then(data => {
						window.location.reload()
					})
			});
		}

		const actualizar_password = document.querySelector('#actualizar_password');
		if (actualizar_password) {
			actualizar_password.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(actualizar_password)
					.then(data => {
						window.location.reload()
					})
			});
		}
	</script>
@endsection
