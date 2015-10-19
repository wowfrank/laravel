@extends('admin.layout')

@section('styles')
	<link href="/assets/pickadate/themes/default.css" rel="stylesheet">
	<link href="/assets/pickadate/themes/default.date.css" rel="stylesheet">
	<link href="/assets/pickadate/themes/default.time.css" rel="stylesheet">
	<link href="/assets/selectize/css/selectize.css" rel="stylesheet">
	<link href="/assets/selectize/css/selectize.bootstrap3.css" rel="stylesheet">
@stop

@section('content')
	<div class="container-fluid">
		<div class="row page-title-row">
			<div class="col-md-12">
				<h3>{{ trans('messages.Team') }} <small>» {{ trans('messages.Create New Member') }}</small></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{ trans('messages.New Member Form') }}</h3>
					</div>
					<div class="panel-body">

						@include('admin.partials.errors')

						<form class="form-horizontal" role="form" method="POST" action="/admin/team">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							@include('admin.team._form')

							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button type="submit" class="btn btn-primary btn-md">
										<i class="fa fa-plus-circle"></i>
										{{ trans('messages.Add New Member') }}
									</button>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('scripts')
	<script src="/assets/pickadate/picker.js"></script>
	<script src="/assets/pickadate/picker.date.js"></script>
	<script src="/assets/pickadate/picker.time.js"></script>
	<script src="/assets/selectize/selectize.min.js"></script>
	<script>
	$(function() {
		$("#dob").pickadate({
			format: "yyyy-mm-dd"
		});
		// $("#gender").selectize({
		// 	create: true
		// });
	});
	</script>
@stop