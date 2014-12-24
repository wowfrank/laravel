@extends('layouts.product')

@section('body')
<!-- error message section -->
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif

<?php $index = 1; ?>
{{ Form::open(array('route' => array('order.store'), 'method' => 'post')) }}
	{{ Form::hidden('order_no', Order::generateRandomStr()) }}
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
				            <th></th>
				            <th>Chinese</th>
				            <th>Brand</th>
				            <th>Unit</th>
				            <th>English</th>
				            <th>Item No</th>
				            <th>Description</th>
				            <th>Quantity</th>
				            <th>Operation</th>
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
									<td>{{Form::text('quantity[]', null, array('class' => 'form-control'))}}</td>
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
{{Form::select('status', [0=>'inactive', 1=>'active'], null, array('class' => 'form-control pull-left')) }}
{{Form::submit('Create Order', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}

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