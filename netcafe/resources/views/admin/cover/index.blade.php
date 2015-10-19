@extends('admin.layout')

@section('content')
	<div class="container-fluid">
		<div class="row page-title-row">
			<div class="col-md-6">
				<h3>{{ trans('messages.Covers') }} <small>» {{ trans('messages.Listing') }} images: slider 1600*750</small></h3>
			</div>
			<div class="col-md-6 text-right">
				<a href="/admin/cover/create" class="btn btn-success btn-md">
					<i class="fa fa-plus-circle"></i> {{ trans('messages.New Cover') }}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				@include('admin.partials.errors')
				@include('admin.partials.success')

				<table id="covers-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>{{ trans('messages.Name') }}</th>
							<th>{{ trans('messages.Title') }}</th>
							<th>{{ trans('messages.Subtitle') }}</th>
							<th>{{ trans('messages.Link Title') }}</th>
							<th>{{ trans('messages.Link') }}</th>
							<th>{{ trans('messages.Create At') }}</th>
							<th>{{ trans('messages.Status') }}</th>
							<th data-sortable="false">{{ trans('messages.Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($covers as $cover)
						<tr>
							<td>{{ $cover->name }}</td>
							<td>{{ $cover->title }}</td>
							<td>{{ str_limit($cover->subtitle, $limit = 50, $end = '...') }}</td>
							<td>{{ $cover->linktitle }}</td>
							<td>{{ str_limit($cover->link, $limit = 30, $end = '...') }}</td>
							<td>{{ $cover->created_at }} </td>
							<td>{{ $cover->active ? trans('messages.Active') : trans('messages.Down') }}</td>
							<td>
								<a href="/admin/cover/{{ $cover->id }}/edit" class="btn btn-xs btn-info">
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
			$("#covers-table").DataTable({
			});
		});
	</script>
@stop