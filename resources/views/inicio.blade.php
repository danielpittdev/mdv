@extends('general.html.blank')

@section('contenido')
	<div class="flex h-full items-center justify-center">
		<div class="max-w-xl space-y-7">
			<p> Hola, soy Daniel González. Soy desarrollador web especializado en Laravel. He creado esta plantilla funcional para que puedas hacer lo que quieras, sí... lo que quieras.</p>

			<p>Puedes romperla, investigar o tomarla como base para tus proyectos, que creo que será lo mejor. Lo que sea, espero que pueda servir para algo y haya muchas funciones que puedas poner.</p>

			<p>Si te sientes bien con lo que estás viendo, podrías hacerme una donación para un café, es lo que se suele decir, aunque no me gusta el café, soy más de ColaCao.</p>

			<h3 class="text-xl font-semibold">Atención</h3>

			<p>Esta plantilla está pensada para que puedas investigar, por lo tanto necesitarás un buen conocimiento previo del uso de Laravel. Lo que ya realizado es el sistema de login, el panel, las animaciones básicas y también los archivos bien preparados para que empieces a agregar lo que quieras.</p>

			<a href="{{ route('login') }}">
				<button class="btn btn-secondary rounded-xl">
					Ir al login
				</button>
			</a>
		</div>
	</div>
@endsection
