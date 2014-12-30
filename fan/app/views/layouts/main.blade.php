<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Authentication App With Laravel 4</title>
		{{ HTML::script(URL::to('/assets/jquery.min.js')) }}
		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style(URL::to('/assets/main.css')) }}
	</head>
 
	<body>
	 	<div class="container">
			<div class="page">
			    <!-- navigation import -->
			    @include('includes.navigation')

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

			<footer style="text-align: center;">
				@include('includes.footer')
			</footer>
		</div>
	</body>
</html>