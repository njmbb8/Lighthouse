<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@yield('pagecss')
    	@include('layouts.partials.head')
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<div class="wrapper">
    		<div id="app">
        		@include('admin.navbar')

        		<main class="py-4">
					<div class="container">
            			@yield('content')
					</div>
        		</main>
    		</div>
		</div>
	</body>
    @include('layouts.partials.footer-scripts')
    @yield('pagescripts')
</html>