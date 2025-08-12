@extends('general.html.panel')

@section('contenido')
	<div class="space-y-4">
		<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
			<div class="p-5 flex items-center justify-between">
				<div class="caja flex gap-5 items-center">
					<img class="sm:size-17 size-15 rounded-xl" src="{{ Storage::url($iglesia->icono) }}" alt="">
					<div>
						<h1 class="text-xl">{{ $iglesia->nombre }}</h1>
						<small>{{ $iglesia->direccion }}</small>
					</div>
				</div>

				<div class="space-x-2">
					<button onclick="modal_eliminar.showModal()" class="btn btn-error btn-sm">
						Eliminar
					</button>
				</div>
			</div>
		</div>

		<div class="grid xl:grid-cols-[.5fr_1fr] sm:grid-cols-1 grid-cols-1 items-start gap-4">

			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 p-5">
				<form action="{{ route('iglesia.update', ['iglesium' => $iglesia->uuid]) }}" id="actualizar_iglesia" method="post" class="w-full">
					@method('PUT')

					<section class="space-y-5">
						<fieldset class="col-span-full">
							<div class="img-group">
								<label for="icono">
									<img src="{{ Storage::url($iglesia->icono ?? 'icons/icono.png') }}" class="preview size-17 p-0 hover:p-[1px] duration-200 rounded-xl object-cover input cursor-pointer">
								</label>
								<input autocomplete="off" type="file" name="icono" id="icono" accept="image/*" class="hidden">
							</div>
						</fieldset>

						<fieldset class="col-span-full">
							<label for="nombre" class="block text-sm/6 font-medium">Nombre</label>
							<div class="mt-2">
								<input autocomplete="off" type="text" name="nombre" id="nombre" value="{{ $iglesia->nombre }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</fieldset>

						<fieldset class="col-span-full">
							<label for="direccion" class="block text-sm/6 font-medium">Dirección</label>
							<div class="mt-2">
								<input autocomplete="off" type="text" name="direccion" id="direccion" value="{{ $iglesia->direccion }}" autocomplete="given-name" class="block w-full rounded-md bg-base-content/2 px-3 py-1.5 text-base ring ring-base-content/15 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
							</div>
						</fieldset>
					</section>

					<div class="mt-10 flex items-center justify-start gap-x-6">
						<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
					</div>
				</form>
			</div>

			<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
				<div class="sivide-solid">
					<section class="border-b border-base-content/5">
						<div class="overflow-x-auto">
							<div class="p-4">
								<span class="font-semibold text-md">Grupos</span>
							</div>
							@if ($iglesia->grupos->isEmpty())
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
										@foreach ($iglesia->grupos as $grupo)
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
				</div>
			</div>
		</div>
	</div>
@endsection

@section('modales')
	<dialog id="modal_eliminar" class="modal">
		<div style="backdrop-filter: blur(5px);" class="p-0 modal-box bg-base-300/50 lg:max-h-[80vh] overflow-auto max-h-[500px] max-w-xl rounded-xl border border-base-content/5 z-10">
			<div class="p-8 space-y-5">
				<h1 class="font-bold">
					Eliminar
				</h1>

				<form id="eliminar_iglesia" method="post" action="{{ route('iglesia.destroy', ['iglesium' => $iglesia->uuid]) }}">
					@method('DELETE')
					<div>
						¿Seguro que quieres eliminar esta iglesia? Todos los datos y sus registros quedarán eliminados sin posibilidad de recuperarse. Todas las personas, seguimientos, grupos y datos quedarán automáticamente eliminados.
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
		const actualizar_iglesia = document.querySelector('#actualizar_iglesia');
		if (actualizar_iglesia) {
			actualizar_iglesia.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(actualizar_iglesia)
					.then(data => {
						window.location.reload()
					})
			});
		}

		// ELIMINAR PERSONA
		const eliminar_iglesia = document.querySelector('#eliminar_iglesia');
		if (eliminar_iglesia) {
			eliminar_iglesia.addEventListener('submit', (event) => {
				event.preventDefault();
				senderAjax(eliminar_iglesia)
					.then(data => {
						window.location.href = "{{ route('panel_iglesias') }}"
					})
			});
		}
	</script>
@endsection
