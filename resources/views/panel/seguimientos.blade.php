@extends('general.html.panel')

@section('contenido')
	<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">

		<div class="p-5 flex items-center justify-between">
			<div class="caja">
				<h1>Seguimientos</h1>
				<small class="text-base-content/50">Panel de seguimientos para personas</small>
			</div>

			<div class="caja">
				<button onclick="modal_crear_seguimiento.showModal()" class="btn btn-primary btn-sm">
					Registrar
				</button>
			</div>
		</div>

		@if ($seguimientos->isEmpty())
			<div class="p-5 text-left text-base-content/50">
				No hay seguimientos registrados.
			</div>
		@else
			<table class="table">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Persona</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($seguimientos as $seguimiento)
						<tr>
							<td>{{ $seguimiento->titulo }}</td>
							<td>
								<a class="w-auto text-blue-500 hover:text-blue-600" href="{{ route('panel_persona_single', ['id' => $seguimiento->persona->uuid]) }}">
									<div class="flex gap-2 items-center">
										<img class="size-6 object-cover rounded-full" src="{{ Storage::url($seguimiento->persona->avatar ?? '/icons/avatar.png') }}" alt="">
										<div class="font-semibold text-xs">{{ $seguimiento->persona->nombre }}</div>
									</div>
								</a>
							</td>
							<td class="text-right">
								<a href="{{ route('panel_seguimiento_single', ['id' => $seguimiento->uuid]) }}">
									<button class="btn btn-primary btn-xs">
										Entar
									</button>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>
@endsection

@section('modales')
	<dialog id="modal_crear_seguimiento" class="modal">
		<div class="modal-box bg-base-300/95 lg:max-h-[80vh] max-h-[500px] max-w-2xl rounded-xl border border-base-content/5 z-10">
			<form action="{{ route('seguimiento.store') }}" id="crear_seguimiento" class="lg:space-y-5 space-y-4" method="post">
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

				<section>
					<div class="space-y-12">

						<section>
							<h2 class="text-base/7 font-semibold">Crear seguimiento</h2>
							<p class="mt-1 text-sm/6 text-base-content/50">Configura un nuevo seguimiento para una persona.</p>

							<div class="mt-7 grid sm:grid-cols-[1fr_1fr] items-start gap-x-6 gap-y-8">

								<section class="col-span-1 space-y-5">
									<fieldset class="fieldset lg:col-span-1 col-span-2">
										<legend class="fieldset-legend">Persona</legend>
										<select name="persona_id" class="h-10 border-0 select select-md block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
											<option disabled selected>Seleccionar una persona</option>
											@foreach ($personas as $persona)
												<option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
											@endforeach
										</select>
									</fieldset>

									<fieldset class="fieldset lg:col-span-1 col-span-2">
										<label for="titulo" class="block text-sm/6 font-medium">Título</label>
										<div>
											<input autocomplete="off" type="text" name="titulo" id="titulo" autocomplete="given-name" class="h-10 block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
										</div>
									</fieldset>

									<fieldset class="fieldset lg:col-span-1 col-span-2">
										<label for="descripcion" class="block text-sm/6 font-medium">Descripción</label>
										<div>
											<textarea class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="descripcion" id="descripcion" cols="30" rows="5"></textarea>
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
											<option value="media">Media</option>
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
						</section>
					</div>
				</section>

				<div class="text-end mt-10">
					<button type="submit" class="btn btn-sm btn-primary">Enviar</button>
				</div>
			</form>
		</div>

		<form method="dialog" class="modal-backdrop z-9">
			<button>close</button>
		</form>
	</dialog>
@endsection

@section('scripts')
	<script>
		//document.getElementById('modal_crear_seguimiento').showModal();
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
	</script>
@endsection
