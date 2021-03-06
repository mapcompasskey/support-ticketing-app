<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SmallBox Support Ticketing System</title>

	<!-- stylesheet -->
	@include('partials._styles')
</head>
<body>

	<div class="content-container">
		<div class="content-inner">
			@include('partials.flash')
			@yield('content')
		</div>
	</div>

	<!-- javascript -->
	@include('partials._scripts')
	@yield('footer')

</body>
</html>
