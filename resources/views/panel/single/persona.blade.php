@extends('general.html.panel')

@section('contenido')
	<div class="space-y-4">
		<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
			<div class="p-5 flex items-center justify-between">
				<div class="caja">
					<h1>{{ $persona->nombre }}</h1>
				</div>

				<div class="space-x-2">
					<button onclick="modal_eliminar.showModal()" class="btn btn-error btn-sm">
						Eliminar
					</button>
					<button onclick="modal_crear_seguimiento.showModal()" class="btn btn-primary btn-sm">
						Crear registro
					</button>
				</div>
			</div>
		</div>

		<div class="grid xl:grid-cols-[1fr_.5fr] sm:grid-cols-[1fr_1fr] grid-cols-1 items-start gap-4">
			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
				<div class="sivide-solid">
					<section class="border-b border-base-content/5">
						<div class="overflow-x-auto">
							<div class="p-4">
								<span class="font-semibold text-md">Grupos</span>
							</div>
							@if ($persona->grupos->isEmpty())
								<div class="p-5 text-left text-base-content/50">
									No se encuentra en ningún grupo
								</div>
							@else
								<table class="table">
									<thead>
										<tr>
											<th>Grupo</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($persona->grupos as $grupo)
											<tr>
												<td>{{ $grupo->nombre }}</td>
												<td class="text-end">
													<a href="{{ route('panel_grupo_single', ['id' => $grupo->uuid]) }}">
														<button class="btn btn-primary btn-xs">
															Acceder
														</button>
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@endif

						</div>
					</section>

					<section>
						<div class="overflow-x-auto">
							<div class="p-4">
								<span class="font-semibold text-md">Seguimientos</span>
							</div>
							@if ($persona->seguimientos->isEmpty())
								<div class="p-5 text-left text-base-content/50">
									No tiene seguimientos
								</div>
							@else
								<table class="table">
									<!-- head -->
									<thead>
										<tr>
											<th>Título</th>
											<th>Estado ánimo</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@foreach ($persona->seguimientos as $seguimiento)
											<tr>
												<td>{{ $seguimiento->titulo }}</td>
												<td>
													@switch($seguimiento->estado_emocional)
														@case('muy mal')
															<div class="badge badge-sm badge-error">Muy mal</div>
														@break

														@case('mal')
															<div class="badge badge-sm badge-warning">Mal</div>
														@break

														@case('normal')
															<div class="badge badge-sm badge-primary">Normal</div>
														@break

														@case('bien')
															<div class="badge badge-sm badge-success">Bien</div>
														@break

														@case('muy bien')
															<div class="badge badge-sm badge-success">Muy bien</div>
														@break

														@default
													@endswitch
												</td>
												<td class="text-end">
													<a href="{{ route('panel_seguimiento_single', ['id' => $seguimiento->uuid]) }}">
														<button class="btn btn-primary btn-xs">
															Acceder
														</button>
													</a>
												</td>
											</tr>
										@endforeach

									</tbody>
								</table>
							@endif
						</div>
					</section>
				</div>
			</div>

			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-5">
				<form action="{{ route('persona.update', ['persona' => $persona->uuid]) }}" id="actualizar_persona" method="post" class="w-full">
					@method('PUT')

					<div class="space-y-8">
						<section>
							<h2 class="text-base/7 font-semibold">Ajustes de la persona</h2>
							<p class="mt-1 text-sm/6 text-base-content/50">Cambia la información de la persona.</p>

							<div class="alerta mt-3 rounded-md bg-red-500/30 text-white p-4 transition-all duration-500 transform opacity-0 pointer-events-none hidden">
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

							<section class="space-y-5 mt-5 grid sm:grid-cols-2 gap-3 gap-y-0">

								<fieldset>
									<div class="img-group">
										<label for="avatar">
											<img src="{{ Storage::url($persona->avatar ?? 'icons/avatar.png') }}" class="preview size-17 p-0 hover:p-[1px] duration-200 rounded-full object-cover input cursor-pointer">
										</label>
										<input autocomplete="off" type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
									</div>
								</fieldset>

								<fieldset class="col-span-full">
									<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="nombre" id="nombre" value="{{ $persona->nombre }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</fieldset>

								<fieldset>
									<label for="apellido_1" class="block text-sm/6 font-medium">Primer apellido</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="apellido_1" id="apellido_1" value="{{ $persona->apellido_1 }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</fieldset>

								<fieldset>
									<label for="apellido_2" class="block text-sm/6 font-medium">Segundo apellido</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="apellido_2" id="apellido_2" value="{{ $persona->apellido_2 }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</fieldset>

								<fieldset class="col-span-full">
									<label for="telefono" class="block text-sm/6 font-medium">Teléfono</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="telefono" id="telefono" value="{{ $persona->telefono }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</fieldset>

								<fieldset class="col-span-full">
									<label for="correo" class="block text-sm/6 font-medium">Correo electrónico</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="correo" id="correo" value="{{ $persona->correo }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</fieldset>

							</section>
						</section>
					</div>

					<div class="mt-10 flex items-center justify-start gap-x-6">
						<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('modales')
	<dialog id="modal_crear_seguimiento" class="modal">
		<div style="backdrop-filter: blur(15px);" class="p-0 modal-box bg-base-300/50 lg:max-h-[80vh] overflow-auto max-h-[500px] max-w-3xl rounded-xl border border-base-content/5 z-10">
			<div class="pan space-y-5 p-6">
				<div class="z-1">
					<h1 class="font-bold">
						Crear nuevo seguimiento
					</h1>
				</div>

				<div class="bg-base-content/2 ring ring-base-content/15 p-3 rounded-xl max-w-auto">
					<div class="pan">
						<div class="flex items-center gap-3">
							<div class="caja">
								<img class="size-9 rounded-full" src="{{ Storage::url($persona->avatar ?? '/icons/avatar.png') }}" alt="">
							</div>
							<div class="info">
								<p class="text-base-content/40 text-xs">Creando registro para:</p>
								<div class="text-sm font-semibold">{{ $persona->nombre . ' ' . $persona->apellido_1 }}</div>
							</div>
						</div>
					</div>
				</div>

				<form action="{{ route('seguimiento.store') }}" id="crear_seguimiento" class="lg:space-y-5 space-y-4" method="post">
					@csrf
					<input autocomplete="off" type="text" class="hidden" value="{{ $persona->id }}" hidden name="persona_id">

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

					<div class="grid sm:grid-cols-[1fr_.5fr] items-start gap-x-6 gap-y-8">
						<section class="col-span-1 space-y-5">
							<fieldset class="fieldset lg:col-span-1 col-span-2">
								<label for="titulo" class="block text-sm/6 font-medium">Título</label>
								<div>
									<input autocomplete="off" type="text" name="titulo" id="titulo" autocomplete="given-name" class="h-10 block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
								</div>
							</fieldset>

							<fieldset class="fieldset lg:col-span-1 col-span-2">
								<label for="descripcion" class="block text-sm/6 font-medium">Descripción</label>
								<div>
									<textarea class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
								</div>
							</fieldset>
						</section>

						<section class="col-span-1 space-y-5">
							<fieldset class="fieldset lg:col-span-1 col-span-2">
								<legend class="fieldset-legend">Estado</legend>
								<select name="estado_emocional" class="h-10 border-0 select select-md block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
									<option disabled selected>Selecciona un estado anímico</option>
									<option value="muy bien">Muy bien</option>
									<option value="bien">Bien</option>
									<option value="normal">Normal</option>
									<option value="mal">Mal</option>
									<option value="muy mal">Muy mal</option>
								</select>
							</fieldset>

							<fieldset class="fieldset lg:col-span-1 col-span-2">
								<legend class="fieldset-legend">Prioridad</legend>
								<select name="prioridad" class="h-10 border-0 select select-md block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
									<option disabled selected>Seleccionar una prioridad</option>
									<option value="alta">Alta</option>
									<option value="normal">Normal</option>
									<option value="baja">Baja</option>
								</select>
							</fieldset>

							<fieldset class="fieldset lg:col-span-1 col-span-2">
								<label for="fecha_recordar" class="block text-sm/6 font-medium">Fecha recordatoria</label>
								<div>
									<input autocomplete="off" type="date" name="fecha_recordar" value="{{ Carbon\Carbon::now()->translatedFormat('Y-m-d') }}" id="fecha_recordar" autocomplete="given-name" class="h-10 block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base border border-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
								</div>
							</fieldset>
						</section>
					</div>

					<div class="text-end mt-10">
						<button type="submit" class="btn btn-sm btn-primary">Enviar</button>
					</div>
				</form>
			</div>
		</div>

		<form method="dialog" class="modal-backdrop opacity-0 z-9">
			<button>close</button>
		</form>
	</dialog>

	<dialog id="modal_eliminar" class="modal">
		<div style="backdrop-filter: blur(5px);" class="p-0 modal-box bg-base-300/50 lg:max-h-[80vh] overflow-auto max-h-[500px] max-w-xl rounded-xl border border-base-content/5 z-10">
			<div class="p-5 space-y-5">
				<h1 class="font-bold">
					Eliminar
				</h1>

				<form id="eliminar_persona" method="post" action="{{ route('persona.destroy', ['persona' => $persona->uuid]) }}">
					@method('DELETE')
					<div>
						¿Seguro que quieres eliminar este registro? La opción no se recuperará.
					</div>

					<button class="btn btn-error btn-sm mt-7" type="submit">
						Eliminar
					</button>
				</form>
			</div>
		</div>

		<form method="dialog" class="modal-backdrop opacity-0 z-9">
			<button>close</button>
		</form>
	</dialog>
@endsection

@section('scripts')
	<script>
		const actualizar_persona = document.querySelector('#actualizar_persona');
		if (actualizar_persona) {
			actualizar_persona.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(actualizar_persona)
					.then(data => {
						window.location.reload()
					})
			});
		}

		// CREAR SEGUIMIENTO
		const crear_seguimiento = document.querySelector('#crear_seguimiento');
		if (crear_seguimiento) {
			crear_seguimiento.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(crear_seguimiento)
					.then(data => {
						window.location.reload()
					})
			});
		}

		// ELIMINAR PERSONA
		const eliminar_persona = document.querySelector('#eliminar_persona');
		if (eliminar_persona) {
			eliminar_persona.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(eliminar_persona)
					.then(data => {
						window.location.href = "{{ route('panel_personas') }}"
					})
			});
		}
	</script>
@endsection
