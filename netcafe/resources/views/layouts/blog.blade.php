<!DOCTYPE html>
<html lang="en">
<head>
	@include('blog.partials.head')
</head>
<body>
@include('blog.partials.page-nav')
@yield('page-header')
@include('blog.partials.header')
@yield('content')

@include('include.footer')

@yield('scripts')

</body>
</html>