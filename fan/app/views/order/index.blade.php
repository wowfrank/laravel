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
		            <th style="width: 8%">Order No</th>
		            <th style="width: 8%">Status</th>
		            <th style="width: 8%">Sum</th>
		            <th style="width: 8%">Labor</th>
		            <th style="width: 8%">Transport</th>
		            <th style="width: 8%">Total</th>
		            <th style="width: 10%">Create Date</th>
		            <th style="width: 10%">Update Date</th>
		            <th style="width: 30%">Operation</th>
		        </tr>
		    </thead>

		    <tbody>
				@foreach ($orderList as $order)
					
					<?php
						switch ($order->status) {
							case '0': echo '<tr class="info">';
								break;
							case '1': echo '<tr>';
								break;
							case '-1': echo '<tr class="warning">';
								break;
							default: echo '<tr>';
								break;
						}
					?>
					
						<td>{{$index}}</td>	
						<td>{{$order->order_no}}</td>
						<td>
							<?php
								switch ($order->status) {
									case '0': echo 'CLOSED';
										break;
									case '1': echo 'ACTIVE';
										break;
									case '-1': echo 'INACTIVE';
										break;
									default: echo 'CLOSED';
										break;
								}
							?>
						</td>
						<td>{{ Form::text('sum', $order->sum, array('class' => 'form-control', 'id' => 'sum'. $order->id)) }}</td>
						<td>
							{{ money_format('%(#3n',$order->sum*0.12) }} 
							{{ Form::hidden('labor', money_format('%(#3n', $order->sum*0.12), array('id' => 'labor'. $order->id)) }}
						</td>
						<td>{{ Form::text('transport', $order->transport, array('class' => 'form-control', 'id' => 'transport'. $order->id)) }}</td>
						<td>{{ money_format('%(#3n', ($order->sum*1.12 + $order->transport)) }}</td>
						<td>{{ $order->created_at }}</td>
						<td>{{ $order->updated_at }}</td>
						<td>
							{{ Form::submit('Save', ['class' => 'btn btn-warning saveSingleOrder', 'id' => $order->id]) }}
							{{ link_to_route('order.show', 'View', [$order->id], ['class' => 'btn btn-info']) }}
							{{ link_to_route('order.edit', 'Update', [$order->id], ['class' => 'btn btn-primary']) }}
							{{ link_to_route('order.download', 'Download', [$order->id], ['class' => 'btn btn-danger']) }}
						</td>
					</tr>
					<?php $index++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
<script type="text/javascript">
	// ajax upload imagen functions
	$('.saveSingleOrder').click(function(ev) {
		var oData = new FormData(),
			orderId = $(this).attr('id');

		oData.append("order_id", orderId);
		oData.append("sum", $('#sum'+orderId).val());
		oData.append("labor", $('#labor'+orderId).val());
		oData.append("transport", $('#transport'+orderId).val());

		var oReq = new XMLHttpRequest();
		oReq.open("POST", "{{ URL::to('order/saveOrder') }}", true);
		oReq.onload = function(oEvent) {
			if (oReq.status == 200) {
				var jsonResponse = JSON.parse(oReq.responseText);
				if ( jsonResponse.success == true ) {
					alert('Saved Successfully!');
				} else {
					alert(jsonResponse.message);
				}
			} else {
				alert("Server Side Error " + oReq.status + " occurred uploading your file. CALL ADMIN!");
			}
		};

		oReq.send(oData);
		
		ev.preventDefault();
	})
</script>
<style>

	div > .row:nth-child(even) {
	   background-color: #FFCCCC;
	}

	div > .row:nth-child(odd) {
	   background-color: #CCE6FF;
	}
</style>
@stop
