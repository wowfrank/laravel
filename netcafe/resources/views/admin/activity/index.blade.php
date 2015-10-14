@extends('admin.layout')

@section('content')
	<div class="container-fluid">
		<div class="row page-title-row">
			<div class="col-md-6">
				<h3>{{ trans('messages.Activity') }} <small>» {{ trans('messages.Listing') }}</small></h3>
			</div>
			<div class="col-md-6 text-right">
				<a href="/admin/activity/create" class="btn btn-success btn-md">
					<i class="fa fa-plus-circle"></i> {{ trans('messages.New Activity') }}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				@include('admin.partials.errors')
				@include('admin.partials.success')

				<table id="activities-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>{{ trans('messages.Activity') }}</th>
							<th>{{ trans('messages.Title') }}</th>
							<th>{{ trans('messages.Status') }}</th>
							<th class="hidden-md">{{ trans('messages.Description') }}</th>
							<th>{{ trans('messages.Create At') }}</th>
							<th data-sortable="false">{{ trans('messages.Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($activities as $activity)
						<tr>
							<td>{{ $activity->id }}</td>
							<td>{{ $activity->title }}</td>
							<th>{{ $activity->status == '0' ? trans('messages.ONGOING') : trans('messages.COMPLETED') }}</th>
							<td class="hidden-md">{{ str_limit($activity->description, $limit = 80, $end = '...') }}</td>
							<td>{{ $activity->created_at }}</td>
							<td>
								<a href="/admin/activity/{{ $activity->id }}/edit" class="btn btn-xs btn-info">
									<i class="fa fa-edit"></i> {{ trans('messages.Edit') }}
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$(function() {
			$("#activities-table").DataTable({
			});
		});
	</script>
@stop