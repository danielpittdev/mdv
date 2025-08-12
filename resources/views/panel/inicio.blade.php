@extends('general.html.panel')

@section('contenido')
	<section class="grid sm:grid-cols-[1fr_1fr] grid-cols-1 items-start gap-4">

		<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
			<div class="p-5 flex items-center justify-between border-b border-base-content/5">
				<div class="caja">
					<h1>Lista de seguimientos</h1>
					<small class="text-base-content/50">Recordatorio de las sesiones pasadas</small>
				</div>

				@if (!Auth::user()->seguimientos->isEmpty())
					<div class="caja">
						<a href="{{ route('panel_seguimientos') }}">
							<button class="btn btn-primary btn-sm">
								Registrar
							</button>
						</a>
					</div>
				@endif
			</div>

			@if (Auth::user()->seguimientos->isEmpty())
				<div class="p-5 text-sm">
					No hay seguimientos que revisar hoy
				</div>
			@else
				<div class="overflow-x-auto">
					<table class="table">
						<thead>
							<th>Persona</th>
							<th>Prioridad</th>
							<th>Ánimo</th>
							<th></th>
						</thead>
						<tbody>
							@foreach ($recordatorios as $recordatorio)
								<tr>
									<td>
										<div class="flex gap-2 items-center">
											<img class="size-7 rounded-full" src="{{ Storage::url($recordatorio->persona->avatar) }}" alt="">
											<div class="flex flex-col">
												<span class="font-light text-md">{{ $recordatorio->persona->nombre }}</span>
											</div>
										</div>
									</td>
									<td>
										@switch($recordatorio->prioridad)
											@case('alta')
												<div class="rounded-sm badge-sm badge badge-error">Alta</div>
											@break

											@case('media')
												<div class="rounded-sm badge-sm badge badge-warning">Media</div>
											@break

											@case('baja')
												<div class="rounded-sm badge-sm badge badge-success">Baja</div>
											@break

											@default
										@endswitch
									</td>
									<td>
										@switch($recordatorio->estado_emocional)
											@case('muy mal')
												<div class="rounded-sm badge-sm badge badge-error">Muy mal</div>
											@break

											@case('mal')
												<div class="rounded-sm badge-sm badge badge-warning">Mal</div>
											@break

											@case('normal')
												<div class="rounded-sm badge-sm badge badge-primary">Normal</div>
											@break

											@case('bien')
												<div class="rounded-sm badge-sm badge badge-success">Bien</div>
											@break

											@case('muy bien')
												<div class="rounded-sm badge-sm badge badge-success">Muy bien</div>
											@break

											@default
										@endswitch
									</td>
									<td class="text-end">
										<a class="text-blue-500 hover:text-blue-600" href="{{ route('panel_seguimiento_single', ['id' => $recordatorio->uuid]) }}">
											Acceder
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
		</div>

		<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
			<div class="p-5 flex items-center justify-between">
				<div class="caja">
					<h1>Lista de personas</h1>
					<small class="text-base-content/50">Lista de personas a tu cargo</small>
				</div>

				<div class="caja">
					<button onclick="modal_crear_persona.showModal()" class="btn btn-primary btn-sm">
						Registrar
					</button>
				</div>
			</div>
		</div>

	</section>
@endsection

@section('scripts')
@endsection
