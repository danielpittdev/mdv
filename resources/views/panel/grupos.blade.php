@extends('general.html.panel')

@section('contenido')
	<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">

		<div class="p-5 flex gap-5 items-center justify-between">
			<div class="caja">
				<h1>Lista de grupos</h1>
				<small class="text-base-content/50">Lista de todos los grupos</small>
			</div>

			<div class="caja">
				<button onclick="modal_crear_grupo.showModal()" class="btn btn-primary btn-sm">
					Crear grupo
				</button>
			</div>
		</div>

		@if ($grupos->isEmpty())
			<div class="p-5 text-left text-base-content/50">
				No hay grupos registrados.
			</div>
		@else
			<table class="table">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Iglesia</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($grupos as $grupo)
						<tr>
							<td>{{ $grupo->nombre }}</td>
							<td>{{ $grupo->iglesia->nombre }}</td>
							<td class="text-right">
								<a href="{{ route('panel_grupo_single', ['id' => $grupo->uuid]) }}">
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
	<dialog id="modal_crear_grupo" class="modal">
		<div class="modal-box bg-base-300/95 lg:max-h-[80vh] max-h-[500px] max-w-md rounded-xl border border-base-content/5 z-10">
			<form action="{{ route('grupo.store') }}" id="crear_grupo" class="lg:space-y-5 space-y-4" method="post">
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
							<h2 class="text-base/7 font-semibold">Información del grupo</h2>
							<p class="mt-1 text-sm/6 text-base-content/50">Vas a registrar un grupo para una de tus iglesias.</p>

							<div class="mt-7 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
								<div class="col-span-full">
									<fieldset>
										<div class="img-group">
											<label for="icono">
												<img src="{{ Storage::url('icons/avatar.png') }}" class="preview size-15 p-0 hover:p-[1px] duration-200 rounded-lg object-cover input cursor-pointer">
											</label>
											<input autocomplete="off" type="file" name="icono" id="icono" accept="image/*" class="hidden">
										</div>
									</fieldset>
								</div>

								<div class="sm:col-span-6">
									<fieldset class="fieldset lg:col-span-1 col-span-2">
										<legend class="fieldset-legend">Iglesia</legend>
										<select name="iglesia_id" class="border-0 select select-md block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
											<option disabled selected>Seleccionar una iglesia</option>
											@foreach ($iglesias as $iglesia)
												<option value="{{ $iglesia->id }}">{{ $iglesia->nombre }}</option>
											@endforeach
										</select>
									</fieldset>
								</div>

								<div class="sm:col-span-6">
									<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
									<div class="mt-2">
										<input autocomplete="off" type="text" name="nombre" id="nombre" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
									</div>
								</div>

								<div class="sm:col-span-6">
									<label for="descripcion" class="block text-sm/6 font-medium">Descripción</label>
									<div class="mt-2">
										<textarea class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="descripcion" id="descripcion" cols="30" rows="5"></textarea>
									</div>
								</div>

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
		//document.getElementById('modal_crear_grupo').showModal();

		const crear_grupo = document.querySelector('#crear_grupo');
		if (crear_grupo) {
			crear_grupo.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(crear_grupo)
					.then(data => {
						window.location.reload()
					})
			});
		}
	</script>
@endsection
