@extends('general.html.panel')

@section('contenido')
	<div class="space-y-4">
		<div class="grid xl:grid-cols-[1fr_1.5fr] md:grid-cols-2 items-start gap-4">
			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-5 space-y-5">

				<div class="flex justify-between items-center">
					<div class="caja font-semibold">
						Ajustes del grupo
					</div>
				</div>

				<form action="{{ route('grupo.update', ['grupo' => $grupo->uuid]) }}" id="actualizar_grupo" method="post" class="max-w-xl">

					@method('PUT')

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
							<div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-1">
								<div>
									<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
									<div class="mt-2">
										<input autocomplete="off" value="{{ $grupo->nombre }}" type="text" name="nombre" id="nombre" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</div>

								<div>
									<label for="descripcion" class="block text-sm/6 font-medium">Descripción</label>
									<div class="mt-2">
										<textarea class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="descripcion" id="descripcion" cols="30" rows="5">{{ $grupo->descripcion }}</textarea>
									</div>
								</div>
							</div>
						</section>
					</div>

					<div class="mt-10 flex items-center justify-start gap-x-6">
						<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
					</div>

				</form>
			</div>

			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
				<div class="p-5 flex justify-between items-center ring ring-b ring-base-content/10">
					<div class="caja font-semibold">
						Servidores
					</div>

					<div class="caja">
						<button onclick="modal_crear_servidor.showModal()" class="btn btn-primary btn-xs">
							Añadir
						</button>
					</div>
				</div>

				@if ($grupo->servidores->isEmpty())
					<div class="p-5">
						<td colspan="3" class="text-left">Sin servidores</td>
					</div>
				@else
					<div class="divide-y divide-base-content/10">
						@foreach ($grupo->servidores as $servidor)
							<div target="{{ $servidor->uuid }}" class="list_item_servidor flex items-center gap-4 p-5 py-3">
								<div class="w-full flex items-center gap-3">
									<img class="size-8 rounded-full" src="{{ Storage::url($servidor->persona->avatar ?? '/icons/avatar.png') }}" alt="">
									<div class="text-sm font-light">
										{{ $servidor->persona->nombre }}
									</div>
								</div>
								<div class="mr-auto badge badge-sm badge-soft badge-warning rounded-sm">{{ $servidor->rol }}</div>
								<button target="{{ $servidor->uuid }}" class="editar_servidor btn btn-primary btn-xs ml-auto">
									Editar
								</button>
							</div>
						@endforeach
					</div>
				@endif
			</div>

			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-5 space-y-5">

				<button onclick="modal_eliminar.showModal()" class="btn btn-error btn-sm">
					Eliminar
				</button>
			</div>
		</div>
	</div>
@endsection

@section('modales')
	<dialog id="modal_crear_servidor" class="modal">
		<div class="modal-box bg-base-300/95 lg:max-h-[80vh] max-h-[500px] max-w-sm rounded-xl border border-base-content/5 z-10">
			<form action="{{ route('servidor.store') }}" id="crear_servidor" class="lg:space-y-5 space-y-4" method="post">
				<input autocomplete="off" hidden type="text" value="{{ $grupo->id }}" name="grupo_id">

				@csrf
				<section>
					<h3 class="lg:text-md font-semibold">Añadir servidor</h3>
				</section>

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

				<section class="grid lg:grid-cols-1 grid-cols-1 gap-2 gap-x-5">
					<div class="lg:col-span-1 col-span-1 gap-4 grid">
						<!-- Campo -->
						<fieldset class="fieldset lg:col-span-1 col-span-2">
							<legend class="fieldset-legend">Persona</legend>
							<select name="persona_id" class="select select-md shadow-none border-[1px] border-base-content/5 w-full">
								<option disabled selected>Seleccionar estado</option>
								@foreach (Auth::user()->iglesias as $iglesia)
									@foreach ($iglesia->personas as $persona)
										<option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
									@endforeach
								@endforeach
							</select>
						</fieldset>

						<fieldset class="fieldset lg:col-span-1 col-span-2">
							<legend class="fieldset-legend">Rol</legend>
							<select name="rol" class="select select-md shadow-none border-[1px] border-base-content/5 w-full">
								<option disabled selected>Seleccionar Rol</option>
								<option value="líder">Líder</option>
								<option value="gestión">Gestión</option>
								<option value="integrante">Integrante</option>
								<option value="capacitador">Capacitador</option>
							</select>
						</fieldset>
					</div>
				</section>

				<button type="submit" class="btn btn-sm btn-primary mt-5">Enviar</button>

			</form>
		</div>

		<form method="dialog" class="modal-backdrop z-9">
			<button>close</button>
		</form>
	</dialog>

	<dialog id="modal_editar_servidor" class="modal">
		<div class="modal-box bg-base-300/95 lg:max-h-[80vh] max-h-[500px] max-w-sm rounded-xl border border-base-content/5 z-10">
			<form action="" id="editar_servidor" class="lg:space-y-5 space-y-4" method="post">
				@csrf
				@method('PUT')
				<section>
					<h3 class="lg:text-md font-semibold">Editar servidor</h3>
				</section>

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

				<section class="space-y-3">
					<!-- Campo -->
					<div class="lg:col-span-auto col-span-1 p-3 bg-base-content/5 ring ring-base-content/10 rounded-md text-xs">
						<div class="flex items-center">
							<div class="caja flex items-center gap-3">
								<img class="size-7 rounded-full hidden" id="modal_icono" src="" alt="">
								<span id="modal_persona"></span>
							</div>
						</div>
					</div>

					<div class="lg:col-span-1 col-span-1 gap-4 grid">
						<!-- Campo -->
						<fieldset class="fieldset lg:col-span-1 col-span-2">
							<legend class="fieldset-legend">Rol</legend>
							<select name="rol" class="select select-md shadow-none border-[1px] border-base-content/5 w-full">
								<option disabled selected>Seleccionar estado</option>
								<option value="líder">Líder</option>
								<option value="gestión">Gestión</option>
								<option value="integrante">Integrante</option>
								<option value="capacitador">Capacitador</option>
							</select>
						</fieldset>
					</div>
				</section>

				<div class="text-end">
					<button type="button" target="" class="btn btn-sm btn-error eliminar_servidor">Eliminar</button>
					<button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
				</div>
			</form>
		</div>

		<form method="dialog" class="modal-backdrop z-9">
			<button>close</button>
		</form>
	</dialog>

	<dialog id="modal_eliminar" class="modal">
		<div style="backdrop-filter: blur(5px);" class="p-0 modal-box bg-base-300/50 lg:max-h-[80vh] overflow-auto max-h-[500px] max-w-xl rounded-xl border border-base-content/5 z-10">
			<div class="p-5 space-y-5">
				<h1 class="font-bold">
					Eliminar
				</h1>

				<form id="eliminar_grupo" method="post" action="{{ route('grupo.destroy', ['grupo' => $grupo->uuid]) }}">
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
		//document.getElementById('modal_editar_servidor').showModal();

		const actualizar_grupo = document.querySelector('#actualizar_grupo');
		if (actualizar_grupo) {
			actualizar_grupo.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(actualizar_grupo)
					.then(data => {
						window.location.reload()
					})
			});
		}

		const crear_servidor = document.querySelector('#crear_servidor');
		if (crear_servidor) {
			crear_servidor.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(crear_servidor)
					.then(data => {
						window.location.reload()
					})
			});
		}

		const editar_servidor = document.querySelector('#editar_servidor');
		if (editar_servidor) {
			editar_servidor.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(editar_servidor)
					.then(data => {
						window.location.reload()
					})
			});
		}

		// Abrir modal para editar
		document.addEventListener('DOMContentLoaded', () => {
			$(document).on('click', '.editar_servidor', function() {
				let id = $(this).attr('target');

				$.ajax({
					type: "get",
					url: `/api/v1/servidor/${id}`,
					dataType: "json",
					success: function(response) {
						const {
							persona,
							rol
						} = response;
						const url_img = persona.avatar ? `{{ Storage::url('') }}` + persona.avatar : null;
						const nombreCompleto = [persona.nombre, persona.apellido_1].filter(Boolean).join(' ');
						$('.eliminar_servidor').attr('target', response.uuid)

						let url_post = `/api/v1/servidor/${response.uuid}`;

						$('#editar_servidor').attr('action', url_post);
						$('#editar_servidor select[name=rol]').val(rol);

						if (url_img) {
							$('#modal_icono').removeClass('hidden').prop('src', url_img);
						} else {
							$('#modal_icono').addClass('hidden').prop('src', '');
						}

						$('#modal_persona').text(nombreCompleto);

						document.getElementById('modal_editar_servidor').showModal();
					}
				});
			})
		});

		// Eliminar
		document.addEventListener('DOMContentLoaded', () => {
			$(document).on('click', '.eliminar_servidor', function() {
				let id = $(this).attr('target');

				$.ajax({
					type: "post",
					url: `/api/v1/servidor/${id}`,
					dataType: "json",
					data: {
						"_method": "DELETE"
					},
					success: function(response) {
						document.getElementById('modal_editar_servidor').close();
						$(`.list_item_servidor[target=${id}]`).remove()
					}
				});
			})
		});

		// eliminar grupo
		const eliminar_grupo = document.querySelector('#eliminar_grupo');
		if (eliminar_grupo) {
			eliminar_grupo.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(eliminar_grupo)
					.then(data => {
						window.location.href = "{{ route('panel_grupos') }}"
					})
			});
		}
	</script>
@endsection
