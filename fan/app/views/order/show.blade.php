@extends('layouts.product')

@section('body')
<!-- error message section -->
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif

<?php $index = 1; ?>
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
									<td>{{$index}}</td><?php $index++; ?>
									<td>{{$product->cname}}</td>
									<td>{{$product->brand}}</td>
									<td>{{$product->unit}}</td>
									<td>{{$product->ename}}</td>
									<td>{{$product->item_no}}</td>
									<td>{{$product->description}}</td>
									<td>{{$product->pivot->quantity}}</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
	@endforeach

{{ HTML::link('order', 'Return', array('class'=>'btn btn-info')) }}

<style>

	div > .row:nth-child(even) {
	   background-color: #FFCCCC;
	}

	div > .row:nth-child(odd) {
	   background-color: #CCE6FF;
	}
</style>
@stop