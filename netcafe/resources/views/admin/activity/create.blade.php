@extends('admin.layout')

@section('content')
	<div class="container-fluid">
		<div class="row page-title-row">
			<div class="col-md-12">
				<h3>{{ trans('messages.Activity') }} <small>» {{ trans('messages.Create New Activity') }}</small></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{ trans('messages.New Activity Form') }}</h3>
					</div>
					<div class="panel-body">

						@include('admin.partials.errors')

						<form class="form-horizontal" role="form" method="POST" action="/admin/activity">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							@include('admin.activity._form')

							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button type="submit" class="btn btn-primary btn-md">
										<i class="fa fa-plus-circle"></i>
										{{ trans('messages.Add New Activity') }}
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