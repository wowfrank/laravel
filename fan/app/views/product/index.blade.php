@extends('layouts.product')

@section('body')
{{ HTML::script(URL::to('/assets/jquery.confirm.min.js')) }}
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
@foreach ($categoryList as $category)
	@if (Product::where('category_id', '=', $category->id)->first())
		<div class="list-group">
			<a class="list-group-item active">
				<h4 class="list-group-item-heading">{{$category->category}}</h4>
			</a>
		    <table class="table table-striped table-bordered table-hover">
		    	<!-- <caption>Product Information in {{$category->category}}<caption> -->
			    <thead>
			        <tr>
			            <th><input type="checkbox" class="checkAll" name="foo[]" /></th>
			            <th>Chinese</th>
			            <th>Brand</th>
			            <th>Unit</th>
			            <th>English</th>
			            <th>Suggest</th>
			            <th>Lowest</th>
			            <th>Item No</th>
			            <th>Description</th>
			            <th>Note</th>
			            <th>Operation</th>
			        </tr>
			    </thead>
			    <tbody>
					@foreach (Product::where('category_id', '=', $category->id)->get() as $product)
						@if ($product->status )
							<tr>
						@else
							<tr class="warning">
						@endif
							<td><input type="checkbox" name="foo[]" value="{{$product->id}}" class="checkbox-class" /></td>
							<td>{{$product->cname}}</td>
							<td>{{$product->brand}}</td>
							<td>{{$product->unit}}</td>
							<td>{{$product->ename}}</td>
							<td>{{money_format('%(#3n', $product->suggest_price)}}</td>
							<td>{{money_format('%(#3n', $product->retail_lowest)}}</td>
							<td>{{$product->item_no}}</td>
							<td>{{$product->description}}</td>
							<td>{{$product->note}}</td>
							<td>
								{{ link_to_route('product.edit', 'Edit', array($product->id), array('class' => 'btn btn-info')) }}
							    <a onclick="confirmDelete({{$product->id}});" class="btn btn-mini btn-danger">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
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

	$(".checkAll").click(function(){
	    $('input:checkbox').not(this).prop('checked', this.checked);
	});
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