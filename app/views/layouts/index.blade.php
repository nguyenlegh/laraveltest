<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			@yield('title')
		</title>
		@section('css')
			{{ HTML::style('vendor/bootstrap-3.3.2/css/bootstrap.min.css') }}
			{{ HTML::style('css/layout.css', array('media' => 'all')) }}
		@show
	</head>
	<body>
		<div class="main-banner">
			@include('layouts.banner')
		</div>
		<div class="main-menu">
			@include('layouts.menu')
		</div>
		<div class="main-container">
			@yield('content')
		</div>
		<div class="main-footer">
			@include('layouts.footer')
		</div>
		
		@section('js')
			{{ HTML::script('vendor/jquery-1.11.2.min.js') }}
			{{ HTML::script('vendor/bootstrap-3.3.2/js/bootstrap.min.js') }}
			{{ HTML::script('js/base.js') }}
		@show
	</body>
</html>
