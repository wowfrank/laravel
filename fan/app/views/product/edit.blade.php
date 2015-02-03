@extends('layouts.product')

@section('body')
@if (Session::has('message'))
  <div>{{ Session::get('message') }}</div>
@endif
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2>Update Product {{$product->id}} </h2>
        {{ Form::model($product, array('method' => 'put', 'route' => array('product.update', $product->id))) }}
        <div class="form-group">
            {{ Form::label('category',trans('message.Category')) }}
            {{ Form::select('category_id', $categoryList, $product->category->id, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('cname',trans('message.Chinese Name')) }}
            {{ Form::text('cname', $product->cname, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('ename',trans('message.English Name')) }}
            {{ Form::text('ename', $product->ename, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('brand',trans('message.Brand Name')) }}
            {{ Form::text('brand', $product->brand, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('unit',trans('message.Unit')) }}
            {{ Form::text('unit', $product->unit, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('suggest_price',trans('message.Suggest Price')) }}
            {{ Form::text('suggest_price', $product->suggest_price, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('retail_lowest',trans('message.Retail Lowest')) }}
            {{ Form::text('retail_lowest', $product->retail_lowest, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description',trans('message.Description')) }}
            {{ Form::text('description', $product->description, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('gross_weight',trans('message.Gross Weight')) }}
            {{ Form::text('gross_weight', $product->gross_weight, array('class' => 'form-control')) }}
        </div>
        <!-- <div class="form-group">
            {{Form::label('item_no','item_no')}}
            {{Form::text('item_no', $product->item_no, array('class' => 'form-control'))}}
        </div> -->
        <div class="form-group">
            {{ Form::label('note',trans('message.Notes')) }}
            {{ Form::text('note', $product->note,array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('status',trans('message.Status')) }}
            {{ Form::radio('status', '1', $product->status == false ? false : true, array('class' => 'form-control')) }} Approved
            {{ Form::radio('status', '0', $product->status == false ? false : true, array('class' => 'form-control')) }} Appending
        </div>

        {{ Form::submit(trans('message.Update'), array('class' => 'btn btn-primary')) }}
        {{ HTML::link('product', trans('message.Return'), ['class'=>'btn btn-info']) }}
        {{ Form::close() }}
    </div>
</div>
@stop