@extends('admin.layout')

@section('content')
	<div class="container-fluid">
		<div class="row page-title-row">
			<div class="col-md-6">
				<h3>{{ trans('messages.Tags') }} <small>» {{ trans('messages.Listing') }}</small></h3>
			</div>
			<div class="col-md-6 text-right">
				<a href="/admin/tag/create" class="btn btn-success btn-md">
					<i class="fa fa-plus-circle"></i> {{ trans('messages.New Tag') }}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				@include('admin.partials.errors')
				@include('admin.partials.success')

				<table id="tags-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>{{ trans('messages.Tag') }}</th>
							<th>{{ trans('messages.Title') }}</th>
							<th class="hidden-sm">{{ trans('messages.Subtitle') }}</th>
							<th class="hidden-md">{{ trans('messages.Page Image') }}</th>
							<th class="hidden-md">{{ trans('messages.Meta Description') }}</th>
							<th class="hidden-md">{{ trans('messages.Layout') }}</th>
							<th class="hidden-sm">{{ trans('messages.Direction') }}</th>
							<th data-sortable="false">{{ trans('messages.Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tags as $tag)
						<tr>
							<td>{{ $tag->tag }}</td>
							<td>{{ $tag->title }}</td>
							<td class="hidden-sm">{{ $tag->subtitle }}</td>
							<td class="hidden-md">{{ $tag->page_image }}</td>
							<td class="hidden-md">{{ $tag->meta_description }}</td>
							<td class="hidden-md">{{ $tag->layout }}</td>
							<td class="hidden-sm">
								@if ($tag->reverse_direction)
									Reverse
								@else
									Normal
								@endif
							</td>
							<td>
								<a href="/admin/tag/{{ $tag->id }}/edit" class="btn btn-xs btn-info">
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
			$("#tags-table").DataTable({
			});
		});
	</script>
@stop