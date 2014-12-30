@extends('layouts.product')

@section('body')
<!-- error message section -->
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif

<?php $index = 1; ?>
{{ Form::model($order, array('method' => 'put', 'route' => array('order.update', $order->id))) }}
	{{ Form::hidden('order_no', $order->order_no) }}
	@foreach ( $categoryList as $category )
		@if ( Product::isCategoryInList($category->id, $productList) )
			<div class="list-group">
				<a class="list-group-item active">
					<h4 class="list-group-item-heading">{{$category->category}}</h4>
				</a>
			    <table class="table table-striped table-bordered table-hover">
			    	<!-- <caption>Product Information in {{$category->category}}<caption> -->
				    <thead>
				        <tr>
				            <th style="width: 2%"></th>
				            <th style="width: 11%">Chinese</th>
				            <th style="width: 10%">Brand</th>
				            <th style="width: 8%">Unit</th>
				            <th style="width: 10%">English</th>
				            <th style="width: 10%">Item No</th>
				            <th style="width: 15%">Description</th>
				            <th style="width: 7%">Quantity</th>
				            <th style="width: 18%">Feedback</th>
				            <th style="width: 8%">Operation</th>
				        </tr>
				    </thead>
				    <tbody>
						@foreach ($productList as $product)
							@if ( $product->category_id == $category->id )
								@if ( $product->status )
								<tr>
								@else
								<tr class="warning">
								@endif
									{{ Form::hidden('product_id[]', $product->id) }}
									<td>{{$index}}</td><?php $index++; ?>
									<td>{{$product->cname}}</td>
									<td>{{$product->brand}}</td>
									<td>{{$product->unit}}</td>
									<td>{{$product->ename}}</td>
									<td>{{$product->item_no}}</td>
									<td>{{$product->description}}</td>
									<td>{{Form::text('quantity[]', $product->pivot->quantity, array('class' => 'form-control'))}}</td>
									<td>{{Form::text('feedback[]', $product->pivot->feedback, array('class' => 'form-control'))}}</td>
									<td>
										<a class="btn btn-mini btn-danger pro-remove">Delete</a>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
	@endforeach
	<div class="row">
		<div class="col-md-2">{{ Form::select('status', ['-1'=> 'INACTIVE', '0'=>'CLOSED', '1'=>'ACTIVE'], $order->status, array('class' => 'form-control', 'style' => 'width: 100px;')) }}</div>
		<div class="col-md-2">{{ Form::submit('Update Order', ['class' => 'btn btn-primary']) }}</div>
		<div class="col-md-2">{{ HTML::link('order', 'Return', ['class'=>'btn btn-info']) }}</div>
	</div>

{{ Form::close() }}

<div class="list-group">
	<a class="list-group-item active">
		<h4 class="list-group-item-heading">Attach Images to Order</h4>
	</a>
    <table class="table table-striped table-bordered table-hover">
	    <tbody>
	    	{{ Form::open(array('url'=>URL::to('order/uploadImage'),'method'=>'POST', 'files'=>true, 'name' => $order->id)) }}
	    	<tr>
	    		<td class="col-md-2">{{ Form::file('images[]', ['multiple'=>true]) }}</td>
	    		<td class="col-md-3">
	    			{{ Form::submit('Attach Images', ['class' => 'btn btn-primary']) }}
	    			{{ Form::reset('Clear form', ['class' => 'btn btn-warning']) }}
    			</td>
	    		<td class="col-md-7 info" id="outputMsg"></td>
	    	</tr>
	    	{{ Form::close() }}
	    </tbody>
	</table>
</div>


<script type="text/javascript">
$(function()
{
	$('.pro-remove').click(function(){
		var answer = confirm('Are you sure you want to remove this product from order?');

		if (answer===true) 
		{
			$(this).closest('tr').remove();
		}
		return false;
	});
})

// ajax upload imagen functions 
var form = document.forms.namedItem("{{ $order->id }}");
form.addEventListener('submit', function(ev) {

	var oData = new FormData(document.forms.namedItem("{{ $order->id }}")),
		oOutput = document.getElementById("outputMsg");

	oData.append("order_id", "{{ $order->id }}");
	oData.append("order_no", "{{ $order->order_no }}");
	oOutput.innerHTML = '';

	var oReq = new XMLHttpRequest();
	oReq.open("POST", "{{ URL::to('order/uploadImage') }}", true);
	oReq.onload = function(oEvent) {
		if (oReq.status == 200) {
			var jsonResponse = JSON.parse(oReq.responseText);
			// alert(jsonResponse.success);
			// oOutput.innerHTML = "Uploaded!";
			if ( jsonResponse.success == true ) {
				oOutput.innerHTML = "Congratulations, Image(s) have been uploaded successfully!";
			} else {
				oOutput.innerHTML = "Bad Experience: " + jsonResponse.message + " Try Again Please";
			}
		} else {
			oOutput.innerHTML = "Server Side Error " + oReq.status + " occurred uploading your file. CALL ADMIN!";
		}
	};

	oReq.send(oData);

	ev.preventDefault();
	}, false
);

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