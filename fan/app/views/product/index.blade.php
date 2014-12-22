@extends('layouts.product')

@section('body')
@foreach ($categoryList as $category)
	<!-- @if ($productList) -->
		<div class="row">
			<div class="col-md-1">
		        {{$category->category}}
		    </div>
		</div>
	<!-- @endif -->
	@foreach ($productList as $product)
		@if ($product->category_id == $category->id)
		    <div class="row">
			    <div class="col-md-1">
			        {{$product->cname}}
			    </div>
			    <div class="col-md-1">
			        {{$product->ename}}
			    </div>
			    <div class="col-md-1">
			        {{$product->brand}}
			    </div>    
			    <div class="col-md-1">
			        {{$product->unit}}
			    </div>
			    <div class="col-md-1">
			        {{$product->description}}
			    </div> 
			    <div class="col-md-1">
			        {{$product->suggest_price}}
			    </div> 
			    <div class="col-md-1">
			        {{$product->retail_lowest}}
			    </div> 
			    <div class="col-md-1">
			        {{$product->item_no}}
			    </div>
			    <div class="col-md-1">
			        {{$product->note}}
			    </div>

			    <div class="col-md-1">
			        <a href="{{ URL::to('product/' . $product->id . '/edit') }}" class="btn btn-mini btn-primary">Edit</a>
			    </div>
			    <div class="col-md-1">
			        <a href="{{ URL::to('product/' . $product->id . '/destroy') }}" class="btn btn-mini btn-info">Delete</a>
			    </div> 
			</div>
		@endif
	@endforeach
@endforeach

@stop