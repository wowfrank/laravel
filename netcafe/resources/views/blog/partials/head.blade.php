<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ isset($meta_description) ? $meta_description : '404 NOT FOUND' }}">
<meta name="author" content="{{ config('blog.author') }}">

<title>{{ trans('messages.Netcafe') }} |  {{ isset($title) ? $title : 'PAGE NOT FOUND' }}</title>
<link rel="shortcut icon" href="/images/favicon.png">

{{-- Styles --}}
<link href="/assets/css/blog.css" rel="stylesheet">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/font-awesome.css">
<link rel="stylesheet" href="/css/templatemo_misc.css">
<link rel="stylesheet" href="/css/templatemo_style.css">
<!-- Custom styles -->
<link rel="stylesheet" href="/css/styles.css">

<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
<script src="/js/bootstrap.js"></script>
<script src="/js/plugins.js"></script>
<script src="/js/main.js"></script>
@yield('styles')

{{-- HTML5 Shim and Respond.js for IE8 support --}}
<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->