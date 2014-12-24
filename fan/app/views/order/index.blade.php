@extends('layouts.product')

@section('body')
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif

<?php $index = 1; ?>
	<div class="list-group">
		<a class="list-group-item active">
			<h4 class="list-group-item-heading">Order List</h4>
		</a>
	    <table class="table table-striped table-bordered table-hover">
		    <thead>
		        <tr>
		            <th style="width: 2%"></th>
		            <th style="width: 10%">Order No</th>
		            <th style="width: 10%">Status</th>
		            <th style="width: 10%">Labor</th>
		            <th style="width: 10%">Transport</th>
		            <th style="width: 10%">Total</th>
		            <th style="width: 18%">Create Date</th>
		            <th style="width: 18%">Update Date</th>
		            <th style="width: 12%">Operation</th>
		        </tr>
		    </thead>
		    <tbody>
				@foreach ($orderList as $order)
					<?php
						switch ($order->status) {
							case '0': echo'<tr class="info">';
								break;
							case '1': echo'<tr>';
								break;
							case '-1': echo'<tr class="warning">';
								break;
							default: echo'<tr>';
								break;
						}
					?>
						<td>{{$index}}</td><?php $index++; ?>	
						<td>{{$order->order_no}}</td>
						<td>
							<?php
								switch ($order->status) {
									case '0': echo'CLOSED';
										break;
									case '1': echo'ACTIVE';
										break;
									case '-1': echo'INACTIVE';
										break;
									default: echo'CLOSED';
										break;
								}
							?>
						</td>
						<td>{{$order->labor}}</td>
						<td>{{$order->transport}}</td>
						<td>{{$order->sum}}</td>
						<td>{{$order->created_at}}</td>
						<td>{{$order->updated_at}}</td>
						<td>
							{{ link_to_route('order.show', 'View', array($order->id), array('class' => 'btn btn-info')) }}
							{{ link_to_route('order.edit', 'Update', array($order->id), array('class' => 'btn btn-primary')) }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

<style>

	div > .row:nth-child(even) {
	   background-color: #FFCCCC;
	}

	div > .row:nth-child(odd) {
	   background-color: #CCE6FF;
	}
</style>
@stop