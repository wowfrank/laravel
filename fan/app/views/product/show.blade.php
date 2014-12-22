@extends('layouts.product')

@section('body')
@foreach ($productList as $product)
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
	</div>
@endforeach
@stop