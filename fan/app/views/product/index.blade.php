@extends('layouts.product')

@section('body')
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
			            <th style="width: 2%"><input type="checkbox" class="checkAll" name="foo[]" /></th>
			            <th style="width: 11%">Chinese</th>
			            <th style="width: 8%">Brand</th>
			            <th style="width: 6%">Unit</th>
			            <th style="width: 12%">English</th>
			            <th style="width: 7%">Suggest</th>
			            <th style="width: 7%">Lowest</th>
			            <th style="width: 8%">Item No</th>
			            <th style="width: 13%">Description</th>
			            <th style="width: 14%">Note</th>
			            <th style="width: 12%">Operation</th>
			        </tr>
			    </thead>
			    <tbody>
					@foreach (Product::where('category_id', '=', $category->id)->orderBy('cname', 'ASC')
			    							->orderBy('brand', 'ASC')
			    							->orderBy('unit', 'ASC')
			    							->orderBy('ename', 'ASC')
			    							->orderBy('note', 'DESC')
			    							->get() as $product)
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
			    url: "/product/"+id,
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