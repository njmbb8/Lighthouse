<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@yield('pagecss')
    	@include('layouts.partials.head')
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
	</head>
	<body>
		<div class="wrapper">
    		<div id="app">
        		@include('layouts.partials.navbar')

        		<main class="py-4">
            		@yield('content')
        		</main>
    		</div>
		</div>
	</body>
    @include('layouts.partials.footer-scripts')
</html>