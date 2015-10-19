<!DOCTYPE html>
<html lang="en">
<head>
	@include('blog.partials.head')
</head>
<body>

@yield('page-header')
@include('message.partials.nav')
@yield('content')

@include('include.footer')

{{-- Scripts --}}
@yield('scripts')

</body>
</html>