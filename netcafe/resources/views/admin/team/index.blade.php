@extends('admin.layout')

@section('content')
	<div class="container-fluid">
		<div class="row page-title-row">
			<div class="col-md-6">
				<h3>{{ trans('messages.Team') }} <small>» {{ trans('messages.Listing') }} images: team 500*500</small></h3>
			</div>
			<div class="col-md-6 text-right">
				<a href="/admin/team/create" class="btn btn-success btn-md">
					<i class="fa fa-plus-circle"></i> {{ trans('messages.New Member') }}
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">

				@include('admin.partials.errors')
				@include('admin.partials.success')

				<table id="teams-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>{{ trans('messages.Name') }}</th>
							<th>{{ trans('messages.Nickname') }}</th>
							<th>{{ trans('messages.Image Name') }}</th>
							<th>{{ trans('messages.Phone') }}</th>
							<th>{{ trans('messages.Duty') }}</th>
							<th>{{ trans('messages.Gender') }}</th>
							<th>{{ trans('messages.Date of Birth') }}</th>
							<th>{{ trans('messages.Weibo') }}</th>
							<th>QQ</th>
							<th>{{ trans('messages.Wechat') }}</th>
							<th>{{ trans('messages.Education') }}</th>
							<th>{{ trans('messages.Status') }}</th>
							<th data-sortable="false">{{ trans('messages.Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($teams as $member)
						<tr>
							<td>{{ $member->name }}</td>
							<td>{{ $member->nickname }}</td>
							<td>{{ $member->imgname }}</td>
							<td>{{ $member->phone }}</td>
							<td>{{ $member->duty }}</td>
							<td>{{ $member->gender == '1' ?  trans('messages.Male') : trans('messages.Female') }}</td>
							<td>{{ $member->dob }}</td>
							<td>{{ $member->weibo }}</td>
							<td>{{ $member->qq }}</td>
							<td>{{ $member->wechat }}</td>
							<td>{{ $member->education }}</td>
							<td>{{ $member->status ? trans('messages.WORKING') : trans('messages.GONE') }}</td>
							<td>
								<a href="/admin/team/{{ $member->id }}/edit" class="btn btn-xs btn-info">
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
			$("#teams-table").DataTable({
			});
		});
	</script>
@stop