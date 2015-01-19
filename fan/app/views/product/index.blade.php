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
			            <th style="width: 11%">English</th>
			            <th style="width: 6%">Unit</th>
			            <th style="width: 7%">Suggest</th>
			            <th style="width: 7%">Lowest</th>
			            <th style="width: 8%">Item No</th>
			            <th style="width: 12%">Description</th>
			            <th style="width: 12%">Note</th>
			            <th style="width: 16%">Operation</th>
			        </tr>
			    </thead>
			    <tbody>
					@foreach (Product::where('category_id', '=', $category->id)->orderBy('cname', 'ASC')
			    							->orderBy('brand', 'ASC')
			    							->orderBy('ename', 'ASC')
			    							->orderBy('unit', 'ASC')
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
							<td>{{$product->ename}}</td>
							<td>{{$product->unit}}</td>
							<td>$ {{money_format('%(#3n', $product->suggest_price)}}</td>
							<td>$ {{money_format('%(#3n', $product->retail_lowest)}}</td>
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
<div class="clearfix">
	<div class="col-md-2">{{ HTML::link('order/create', 'Create Order', ['class'=>'btn btn-warning', 'id' => 'create-order']) }}</div>
</div>
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

	$(".checkAll").click(function(e){
		var table = $(e.target).closest('table');
	    $('input:checkbox', table).not(this).prop('checked', this.checked);
	});

    $(function()
    {
        $('#create-order').click(function(e)
        {
            e.preventDefault();

            if( $('input[class="checkbox-class"]:checked').length > 0 ) 
            {
                var dataString = JSON.stringify($('input[class="checkbox-class"]:checked').serializeArray());
                var f = jQuery("<form>", { action: "{{ URL::to('order/create') }}", method: 'post' });

                f.append(
                    $("<input>", { type: "hidden", name: "dataString", value: dataString })
                );
                $(document.body).append(f);
                f.submit();
            } else {
                //if nothing has been checked, prompt error message
                alert('Please choose products that you want to add to order!');
            }

            return false;
        });
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
