<!doctype html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]);?></script>
		<script src="{{ asset('js/app.js') }}" defer></script>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body>
        <div id="app">
            <main-vue></main-vue>
        </div>
		{{-- @yield('guest_index') --}}
		@yield('search')
		@yield('user-panel')
		@yield('login')
		@yield('register')
		@yield('apt-show')
		@yield('new-apt-upa')
	</body>
</html>
