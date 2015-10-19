<!DOCTYPE html>
<html lang="en">
<head>
	@include('blog.partials.head')
	<script src="/js/vendor/jquery.infinitescroll.min.js"></script>
</head>
<body>

@yield('page-header')
{{-- @include('message.partials.header') --}}
@yield('content')

@include('include.footer')

{{-- Scripts --}}
@yield('scripts')

</body>
</html>