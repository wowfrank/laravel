@extends('layouts.product')

@section('body')
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif

<div class="list-group">
	<a class="list-group-item active">
		<h4 class="list-group-item-heading">Balance Detail Creation</h4>
	</a>
	{{ Form::open(array('route' => array('balance.store'), 'method' => 'post', 'files' => true)) }}

	<div class="form-group col-md-1">
		{{ Form::label('tran_date','Transfer Date') }}
		{{ Form::text('tran_date', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group col-md-1">
		{{ Form::label('transfered','Transfer Amount') }}
		{{ Form::text('transfered', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group col-md-2">
		{{ Form::label('tran_screenshot','Transfer Screenshot') }}
		{{ Form::file('tran_screenshot', null, array('id'=>'', 'class'=>'form-control')) }}
	</div>

	<div class="form-group col-md-1">
		{{ Form::label('rece_date','Received Date') }}
		{{ Form::text('rece_date', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group col-md-1">
		{{ Form::label('received','Received Amount') }}
		{{ Form::text('received', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group col-md-2">
		{{ Form::label('rece_screenshot','Received Screenshot') }}
		{{ Form::file('rece_screenshot', null, array('id'=>'', 'class'=>'form-control')) }}
	</div>
	<div class="form-group col-md-1">
		{{ Form::label('operation', 'Operation') }}
		{{ Form::submit('Save', ['class' => 'btn btn-warning']) }}
	</div>

	{{ Form::close() }}
</div>
<div class="clearfix"></div>
<hr />

<div class="list-group">
	<a class="list-group-item active">
		<h4 class="list-group-item-heading">Balance Summary</h4>
	</a>
	<table class="table table-striped table-bordered table-hover">
	    <thead>
	        <tr>
	            <th style="width: 2%"></th>
	            <th style="width: 14%">Total Send</th>
	            <th style="width: 14%">Total Received</th>
	            <th style="width: 14%">Totoal Trans Fee</th>
	            <th style="width: 14%">Total Shopped</th>
	            <th style="width: 14%">Total Labor</th>
	            <th style="width: 14%">Total Transport</th>
	            <th style="width: 14%">Closed Balanced</th>
	        </tr>
	    </thead>

	    <tbody>
			<tr>
				<td></td>			 	
				<td> $ {{money_format('%(#3n', $totalSent)}} </td>	
				<td> $ {{money_format('%(#3n', $totalReceived)}} </td>
				<td> $ {{money_format('%(#3n', ($totalSent - $totalReceived))}} </td>
				<td> $ {{money_format('%(#3n', $totalShopped)}} </td>
				<td> $ {{money_format('%(#3n', ($totalShopped * 0.12))}} </td>
				<td> $ {{money_format('%(#3n', $totalTransport)}} </td>
				<td> $ {{money_format('%(#3n', ($totalReceived - $totalShopped * 1.12 - $totalTransport))}} </td>
			</tr>
		</tbody>
	</table>
</div>
<div class="clearfix"></div>
<hr />

<?php $index = 1; ?>
	<div class="list-group">
		<a class="list-group-item active">
			<h4 class="list-group-item-heading">Balance List</h4>
		</a>
	    <table class="table table-striped table-bordered table-hover">
		    <thead>
		        <tr>
		            <th style="width: 2%"></th>
		            <th style="width: 10%">Date</th>
		            <th style="width: 10%">Sent</th>
		            <th style="width: 14%">Image</th>
		            <th style="width: 2%"></th>
		            <th style="width: 10%">Date</th>
		            <th style="width: 10%">Received</th>
		            <th style="width: 14%">Image</th>
		            <th style="width: 12%">Operation</th>
		        </tr>
		    </thead>

		    <tbody>
				@foreach ($balanceList as $balance)
					<tr>
						<td>{{$index}}</td>	
						<td>{{ Form::text('tran_date', $balance->tran_date, array('class' => 'form-control', 'id' => 'tran_date'.$balance->id)) }}</td>
						<td>{{ Form::text('transfered', $balance->transfered, array('class' => 'form-control', 'id' => 'transfered'.$balance->id)) }}</td>
						<td><a href="/{{ $balance->path . $balance->tran_screenshot}}">
							{{ HTML::image('packages/uploads/thumbnails/thumb-' . $balance->tran_screenshot, 'null', array('class' => 'img-rounded img-responsive')) }}
						</a></td>
						<td></td>
						
						<td>{{ Form::text('rece_date', $balance->rece_date, array('class' => 'form-control', 'id' => 'rece_date'.$balance->id)) }}</td>
						<td>{{ Form::text('received', $balance->received, array('class' => 'form-control', 'id' => 'received'.$balance->id)) }}</td>
						<td><a href="/{{ $balance->path . $balance->rece_screenshot}}">
							{{ HTML::image('packages/uploads/thumbnails/thumb-' . $balance->rece_screenshot, 'null', array('class' => 'img-rounded img-responsive')) }}
						</a></td>
						<td>
							{{ Form::submit('Update', ['class' => 'btn btn-warning updateInfo', 'id' => $balance->id]) }}
							<a onclick="confirmDelete({{$balance->id}});" class="btn btn-mini btn-danger">Delete</a>
						</td>
					</tr>
					<?php $index++; ?>
				@endforeach
			</tbody>
		</table>
		{{ HTML::link('product', 'Return', ['class'=>'btn btn-info']) }}
	</div>
<script type="text/javascript">
	// ajax upload imagen functions
	$('.updateInfo').click(function(ev) {
		var oData = new FormData(),
			balanceId = $(this).attr('id');

		oData.append( "id", balanceId);
		oData.append( "tran_date", $('#tran_date'+balanceId).val() );
		oData.append( "transfered", $('#transfered'+balanceId).val() );
		oData.append( "rece_date", $('#rece_date'+balanceId).val() );
		oData.append( "received", $('#received'+balanceId).val() );

		var oReq = new XMLHttpRequest();
		oReq.open("POST", "{{ URL::to('balance/updateBalance') }}", true);
		oReq.onload = function(oEvent) {
			if (oReq.status == 200) {
				var jsonResponse = JSON.parse(oReq.responseText);
				if ( jsonResponse.success == true ) {
					alert('Saved Successfully!');
				} else {
					alert(jsonResponse.message);
				}
			} else {
				alert("Server Side Error " + oReq.status + " occurred updating your info. CALL ADMIN!");
			}
		};

		oReq.send(oData);

		ev.preventDefault();
	})

	function confirmDelete(id)
	{
		var answer = confirm('Are you sure you want to delete this product?');

		if (answer===true)
		{
			$.ajax({
			    url: "/balance/"+id,
			    type: 'DELETE',
			    success: function(result) {
			    	if (result == true) alert( 'ok' );
			    	else alert('false') ;
			    }
			});
		}
		return false;
	}
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