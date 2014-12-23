@extends('layouts.product')

@section('body')
{{ HTML::script(URL::to('/assets/jquery.confirm.min.js')) }}
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
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
			        {{ link_to_route('product.edit', 'Edit', array($product->id), array('class' => 'btn btn-info')) }}
			    </div>
			    <div class="col-md-1">
			        <!-- <a href="{{ URL::to('product/' . $product->id . '/destroy') }}" class="btn btn-mini btn-danger to-delete">Delete</a> -->
			        <a onclick="confirmDelete({{$product->id}});" class="btn btn-mini btn-danger">Delete</a>
			    </div> 
			</div>
		@endif
	@endforeach
@endforeach
<script type="text/javascript">
	function confirmDelete(id)
	{
		var answer = confirm('Are you sure you want to delete this product?');

		if (answer===true)
		{
			$.ajax({
			    url: "{{ URL::to('product/' . $product->id) }}",
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
@stop