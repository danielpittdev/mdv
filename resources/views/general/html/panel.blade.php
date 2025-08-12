<!DOCTYPE html>
<html lang="en" data-theme="dark" class="h-[100vh] bg-base-100/85">

	<head>
		<meta name="theme-color" content="{{ request()->cookie('theme', '#1b2025') }}" id="theme-color-meta-v2" />

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Panel</title>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="manifest" href="/laravelpwa/manifest.json">
		<script>
			if ('serviceWorker' in navigator) {
				navigator.serviceWorker.register('/laravelpwa/serviceworker.js')
					.then(function() {
						console.log("PWA service worker registered");
					});
			}
		</script>

		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>

	<body class="h-full group @if (request()->cookie('sidebar_estado') === 'plegado') sidebar-plegado @endif">
		<div>
			@include('general.fragmentos.aside')

			<div class="intra_main lg:pl-64 group-[.sidebar-plegado]:lg:pl-17 transition-all duration-500">
				@include('general.fragmentos.nav')

				<main class="lg:py-10 py-7 max-w-7xl pb-15">
					<div class="px-4 sm:px-6 lg:px-8">

						@yield('contenido')
						@yield('modales')
						@yield('scripts')

					</div>
				</main>
			</div>
		</div>
	</body>

</html>
