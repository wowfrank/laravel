<!DOCTYPE html>
<html lang="en">
<head>
	@include('blog.partials.head')
</head>
<body>

@yield('page-header')
@include('blog.partials.header')
@yield('content')

@include('include.footer')

@yield('scripts')

</body>
</html>