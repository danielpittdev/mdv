<!DOCTYPE html>
<html lang="en" data-theme="forest" class="h-full bg-base-100">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Vitalic Light - Auth</title>
		<meta name="theme-color" id="theme-color-meta-v2" />
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
		@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/jquery.js'])
	</head>

	<body class="h-full">
		@yield('contenido')
		@yield('scripts')
	</body>

</html>
