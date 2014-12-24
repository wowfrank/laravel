@extends('layouts.product')

@section('body')
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif

@foreach ($orderList as $order)
	<div class="list-group">
		<a class="list-group-item active">
			<h4 class="list-group-item-heading">Order List</h4>
		</a>
	    <table class="table table-striped table-bordered table-hover">
	    	<!-- <caption>Product Information in {{$order->order_no}}<caption> -->
		    <thead>
		        <tr>
		            <th></th>
		            <th>Order No</th>
		            <th>Status</th>
		            <th>Labor</th>
		            <th>Transport</th>
		            <th>Total</th>
		            <th>Create Date</th>
		            <th>Update Date</th>
		            <th>Operation</th>
		        </tr>
		    </thead>
		    <tbody>
				@foreach ($orderList as $order)
					@if ($order->status )
						<tr>
					@else
						<tr class="warning">
					@endif
						<td></td>
						<td>{{$order->order_no}}</td>
						<td>{{$order->status}}</td>
						<td>{{$order->labor}}</td>
						<td>{{$order->transport}}</td>
						<td>{{$order->sum}}</td>
						<td>{{$order->created_at}}</td>
						<td>{{$order->updated_at}}</td>
						<td>
							{{ link_to_route('order.edit', 'Update', array($order->id), array('class' => 'btn btn-info')) }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endforeach

<style>

	div > .row:nth-child(even) {
	   background-color: #FFCCCC;
	}

	div > .row:nth-child(odd) {
	   background-color: #CCE6FF;
	}
</style>
@stop