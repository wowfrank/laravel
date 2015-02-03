@extends('layouts.product')

@section('body')
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
{{ Form::open(array('route' => array('order.save2order'), 'method' => 'post')) }}
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
			            <th style="width: 15%">{{ trans('message.Chinese') }}</th>
			            <th style="width: 15%">{{ trans('message.Brand') }}</th>
			            <th style="width: 16%">{{ trans('message.English') }}</th>
			            <th style="width: 6%">{{ trans('message.Unit') }}</th>
			            <th style="width: 7%">{{ trans('message.Suggest') }}</th>
			            <th style="width: 7%">{{ trans('message.Lowest') }}</th>
			            <!-- <th style="width: 8%">{{ trans('message.Item No') }}</th> -->
			            <th style="width: 12%">{{ trans('message.Description') }}</th>
			            <th style="width: 12%">{{ trans('message.Notes') }}</th>
			            <th style="width: 8%">{{ trans('message.Operation') }}</th>
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
							<td>{{ Form::checkbox('foo[]', $product->id, false, ['class'=>'checkbox-class']) }}</td>
							<td>{{$product->cname}}</td>
							<td>{{$product->brand}}</td>
							<td>{{$product->ename}}</td>
							<td>{{$product->unit}}</td>
							<td>$ {{money_format('%(#3n', $product->suggest_price)}}</td>
							<td>$ {{money_format('%(#3n', $product->retail_lowest)}}</td>
							<!-- <td>{{$product->item_no}}</td> -->
							<td>{{$product->description}}</td>
							<td>{{$product->note}}</td>
							<td>
								{{ link_to_route('product.edit', trans('message.Edit'), array($product->id), array('class' => 'btn btn-info')) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
@endforeach
<div class="clearfix">
	<div class="col-md-2">{{ Form::submit(trans('message.Save 2 Order') .' #'.$orderId, ['class' => 'btn btn-warning', 'id' => 'add-2-order']) }}{{ Form::close() }}</div>
</div>
<script type="text/javascript">
	$(".checkAll").click(function(e){
		var table = $(e.target).closest('table');
	    $('input:checkbox', table).not(this).prop('checked', this.checked);
	});
	
    $(function()
    {
        $('#add-2-order').click(function(e)
        {
            e.preventDefault();

            if( $('input[class="checkbox-class"]:checked').length > 0 ) 
            {
                var dataString = JSON.stringify($('input[class="checkbox-class"]:checked').serializeArray());
                var f = jQuery("<form>", { action: "{{ URL::to('order/saveToOrder/'.$orderId) }}", method: 'post' });

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
