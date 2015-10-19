<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin | {{ trans('messages.Netcafe') }} | {{ config('blog.title') }} </title>

	<link href="/assets/css/admin.css" rel="stylesheet">
	<link rel="shortcut icon" href="/images/favicon.png">
	<link rel="stylesheet" href="/css/font-awesome.css">
	<script src="/js/vendor/jquery-2.1.3.min.js"></script>
	@yield('styles')

	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

{{-- Navigation Bar --}}
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">My Logo</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-menu">
			@include('admin.partials.navbar')
		</div>
	</div>
</nav>

@yield('content')
@include('include.footer')

<script src="/assets/js/admin.js"></script>

@yield('scripts')

</body>
</html>