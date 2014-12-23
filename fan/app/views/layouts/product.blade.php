<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Authentication App With Laravel 4</title>
		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style(URL::to('/assets/main.css')) }}
		{{ HTML::script(URL::to('/assets/jquery.min.js')) }}
	</head>

	<body>
	 
		<div class="page">
		    <div class="container-fluid">
		        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		            <div class="container">
		                <div class="navbar-header">
		                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		                        <span class="sr-only">Toggle navigation</span>
		                        <span class="icon-bar"></span>
		                        <span class="icon-bar"></span>
		                        <span class="icon-bar"></span>
		                    </button>
		                    <a class="navbar-brand" href="/">Laravel</a>
		                </div>

		                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		                    <ul class="nav navbar-nav navbar-right">
		                        @if (Sentry::check())
			                        <li>{{ HTML::link('logout', 'Log Out') }}</li>
			                        <li><a href="/profile">{{ Sentry::getUser()->first_name }}</a></li>
		                        @else
			                        <li>{{ HTML::link('login', 'Login') }}</li>
			                        <li>{{ HTML::link('register', 'Register') }}</li>
		                        @endif
		                    </ul>

		                </div><!-- /.navbar-collapse -->
		            </div>
		        </nav>
		    </div>
		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-md-4 col-md-offset-4">
		                @if(Session::has('message'))
		                <div class="alert-box success">
		                    <h2>{{ Session::get('message') }}</h2>
		                </div>
		                @endif
		            </div>
		        </div>
		    </div>
		    @yield('body')
		</div>
		@show
	</body>
</html>