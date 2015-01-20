@extends('layouts.product')

@section('body')
<!-- error message section -->
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
<div class="content">
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
				            <th style="width: 2%"></th>
				            <th style="width: 12%">Chinese</th>
				            <th style="width: 14%">Brand</th>
				            <th style="width: 16%">English</th>
				            <th style="width: 8%">Unit</th>
				            <!-- <th style="width: 8%">Item No</th> -->
				            <th style="width: 8%">Quantity</th>
				            <th style="width: 20%">Extra</th>
				            <th style="width: 20%">Feedback</th>
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
									<td>{{$product->ename}}</td>
									<td>{{$product->unit}}</td>
									<!-- <td>{{$product->item_no}}</td> -->
									<td>{{$product->pivot->quantity}}</td>
									<td>{{$product->pivot->extra}}</td>
									<td>{{$product->pivot->feedback}}</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
	@endforeach
</div>

<div class="imageContent">
	<div class="list-group">
		<a class="list-group-item active">
			<h4 class="list-group-item-heading">Attachments</h4>
		</a>
	    <table class="table table-striped table-bordered table-hover">
		    <tbody>
		    	<?php $imgItem = 0;?>
				@foreach ($images as $image)
				<?php echo $imgItem%6 == 0 ? '<tr>' : '' ;?>
					<td  class="col-md-1"><a href="/{{ $image->path . $image->filename}}">
						{{ HTML::image('packages/uploads/thumbnails/thumb-' . $image->filename, 'null', array('class' => 'img-rounded img-responsive')) }}
					</a>
					<?php echo $image->watermark ? '' : HTML::link('order/watermark/'.$image->id, 'WaterMark', array('class'=>'btn btn-info')); ?>
					</td>
				<?php $imgItem++; ?>
				<?php echo $imgItem%6 == 0 ? '</tr>' : '' ;?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
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