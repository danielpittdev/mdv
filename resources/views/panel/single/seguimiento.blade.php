@extends('general.html.panel')

@section('contenido')
	<div class="space-y-4">
		<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
			<div class="p-5 flex items-center justify-between">
				<div class="caja">
					<h1>Información de seguimiento</h1>
				</div>

				<div class="flex caja space-x-2">
					<button onclick="modal_cronologia.showModal()" class="btn btn-primary btn-sm">
						Historial
					</button>

					<button onclick="modal_eliminar.showModal()" class="btn btn-error btn-sm">
						Eliminar
					</button>
				</div>
			</div>
		</div>

		<div class="grid xl:grid-cols-[1fr_.5fr] sm:grid-cols-[1fr_1fr] grid-cols-1 items-start gap-4">
			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-5">
				<form action="{{ route('seguimiento.update', ['seguimiento' => $seguimiento->uuid]) }}" id="actualizar_seguimiento" method="post" class="w-full">
					@method('PUT')

					<div class="space-y-8">
						<section>
							<h2 class="text-base/7 font-semibold">Información del seguimiento</h2>
							<p class="mt-1 text-sm/6 text-base-content/50">Cambia la información del seguimiento.</p>

							<div class="mt-5 grid gap-6">
								<div class="sm:col-span-4">
									<fieldset>
										<div class="sm:col-span-4">
											<label for="titulo" class="block text-sm/6 font-medium">Título</label>
											<div class="mt-2">
												<input autocomplete="off" type="text" name="titulo" id="titulo" value="{{ $seguimiento->titulo }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
											</div>
										</div>
									</fieldset>
								</div>

								<div class="sm:col-span-4">
									<fieldset>
										<div class="sm:col-span-4">
											<label for="titulo" class="block text-sm/6 font-medium">Título</label>
											<div class="mt-2">
												<textarea class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="descripcion" id="descripcion" cols="30" rows="10">{{ $seguimiento->descripcion }}</textarea>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
						</section>
					</div>

					<div class="mt-10 flex items-center justify-start gap-x-6">
						<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>
					</div>
				</form>
			</div>

			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-5">
				<form action="{{ route('seguimiento.update', ['seguimiento' => $seguimiento->uuid]) }}" id="actualizar_seguimiento_2" method="post" class="w-full">
					@method('PUT')
					<div class="space-y-8">
						<section>
							<h2 class="text-base/7 font-semibold">Ajustes del seguimiento</h2>
							<p class="mt-1 text-sm/6 text-base-content/50">Cambia la información del seguimiento.</p>

							<section class="space-y-5 mt-5">
								<fieldset class="fieldset lg:col-span-1 col-span-2">
									<legend class="fieldset-legend">Estado</legend>
									<select name="estado_emocional" class="h-10 border-0 select select-md block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
										<option disabled hidden selected>{{ ucfirst($seguimiento->estado_emocional) }}</option>
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
										<option disabled hidden selected>{{ ucfirst($seguimiento->prioridad) }}</option>
										<option value="alta">Alta</option>
										<option value="media">Media</option>
										<option value="baja">Baja</option>
									</select>
								</fieldset>

								<fieldset class="fieldset lg:col-span-1 col-span-2">
									<label for="fecha_recordar" class="block text-sm/6 font-medium">Fecha recordatoria</label>
									<div>
										<input autocomplete="off" type="date" name="fecha_recordar" value="{{ Carbon\Carbon::parse($seguimiento->fecha_recordatoria)->translatedFormat('Y-m-d') }}" id="fecha_recordar" autocomplete="given-name" class="h-10 block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base border border-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</fieldset>
							</section>
						</section>
					</div>

					<div class="mt-10 flex items-center justify-start gap-x-6">
						<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('modales')
	<dialog id="modal_cronologia" class="modal">
		<div style="backdrop-filter: blur(5px);" class="p-0 modal-box bg-base-300/50 lg:max-h-[80vh] overflow-auto max-h-[500px] max-w-xl pb-10 rounded-xl border border-base-content/5 z-10">
			<div class="pan space-y-1">
				<div class="p-5 z-1">
					<h1 class="font-bold">
						Historial
					</h1>
				</div>

				<div class="px-5">
					<ul class="space-y-4">
						@foreach ($seguimientosAgrupados as $fecha => $items)
							<li class="space-y-2">
								<div class="text-xs font-semibold uppercase tracking-wide text-base-content/50">
									{{ \Carbon\Carbon::parse($fecha)->locale('es')->translatedFormat('l d F Y') }}
								</div>

								<ul class="space-y-2">
									@foreach ($items as $s)
										<li class="p-3 rounded-md bg-base-200 flex justify-between gap-4">
											<div class="space-y-1">
												<div class="text-sm font-medium mb-3 space-y-2">
													<div>
														@switch($s->estado_emocional)
															@case('muy mal')
																<div class="rounded-sm badge-xs badge badge-error">Muy mal</div>
															@break

															@case('mal')
																<div class="rounded-sm badge-xs badge badge-warning">Mal</div>
															@break

															@case('normal')
																<div class="rounded-sm badge-xs badge badge-primary">Normal</div>
															@break

															@case('bien')
																<div class="rounded-sm badge-xs badge badge-success">Bien</div>
															@break

															@case('muy bien')
																<div class="rounded-sm badge-xs badge badge-success">Muy bien</div>
															@break

															@default
														@endswitch

														@switch($s->prioridad)
															@case('alta')
																<div class="rounded-sm badge-xs badge badge-soft badge-error">Alta</div>
															@break

															@case('media')
																<div class="rounded-sm badge-xs badge badge-soft badge-warning">Media</div>
															@break

															@case('baja')
																<div class="rounded-sm badge-xs badge badge-soft badge-primary">Baja</div>
															@break

															@default
														@endswitch
													</div>

													<div>
														{{ $s->titulo ?: 'Sin título' }}
													</div>
												</div>
												<div class="text-xs text-base-content/60 leading-snug">
													{{ Str::limit($s->descripcion, 500) }}
												</div>
												<div class="text-[11px] text-base-content/40">
													{{ $s->created_at->format('H:i') }}
													· Estado: {{ $s->estado_emocional }}
													· Prioridad: {{ $s->prioridad }}
												</div>
											</div>
											<a href="{{ route('panel_seguimiento_single', ['id' => $s->uuid]) }}" class="btn btn-xs btn-primary">Ver</a>
										</li>
									@endforeach
								</ul>
							</li>
						@endforeach
					</ul>

				</div>
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

				<form id="eliminar_seguimiento" method="post" action="{{ route('seguimiento.destroy', ['seguimiento' => $seguimiento->uuid]) }}">
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
		document.getElementById('modal_crear_seguimiento').showModal();
	</script>
	<script>
		const actualizar_seguimiento = document.querySelector('#actualizar_seguimiento');
		const actualizar_seguimiento_2 = document.querySelector('#actualizar_seguimiento_2');

		if (actualizar_seguimiento) {
			actualizar_seguimiento.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(actualizar_seguimiento)
					.then(data => {
						window.location.reload()
					})
			});
		}
		if (actualizar_seguimiento_2) {
			actualizar_seguimiento_2.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(actualizar_seguimiento_2)
					.then(data => {
						window.location.reload()
					})
			});
		}

		const eliminar_seguimiento = document.querySelector('#eliminar_seguimiento');
		if (eliminar_seguimiento) {
			eliminar_seguimiento.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(eliminar_seguimiento)
					.then(data => {
						window.location.href = "{{ route('panel_persona_single', ['id' => $seguimiento->persona->uuid]) }}"
					})
			});
		}
	</script>
@endsection
