<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SmallBox Support Ticketing System</title>

	<!-- stylesheet -->
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>

	{{--@include('partials.nav')--}}

	<div class="container">
		{{--@include('partials.flash')--}}
		@yield('content')
	</div>

	<!-- javascript -->
	<script src="/js/app.js"></script>

	@yield('footer')

</body>
</html>
