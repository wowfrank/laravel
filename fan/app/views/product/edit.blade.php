@extends('layouts.product')

@section('body')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2>Update {{$product->id}}</h2>
        {{ Form::open(array('route' => array('product.update', $product->id), 'method' => 'post')) }}
        <div class="form-group">
            {{Form::label('category','Category')}}
            {{Form::select('category_id', $categoryList, 'abc', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{Form::label('cname','Chinese Name')}}
            {{Form::text('cname', $product->cname, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('ename','English Name')}}
            {{Form::text('ename', $product->ename, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('brand','Brand Name')}}
            {{Form::text('brand', $product->brand, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('unit','Unit')}}
            {{Form::text('unit', $product->unit, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('suggest_price','Suggest Price')}}
            {{Form::text('suggest_price', $product->suggest_price, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('retail_lowest','Retail Lowest')}}
            {{Form::text('retail_lowest', $product->retail_lowest, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('description','Description')}}
            {{Form::text('description', $product->description, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('gross_weight','Gross Weight')}}
            {{Form::text('gross_weight', $product->gross_weight, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('item_no','item_no')}}
            {{Form::text('item_no', $product->item_no, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('status','Status')}}
            <!-- {{Form::text('status', null, array('class' => 'form-control'))}} -->
            {{ Form::radio('status', '1', $product->status == false ? false : true, array('class' => 'form-control')) }} Approved
            {{ Form::radio('status', '0', $product->status == false ? false : true, array('class' => 'form-control')) }} Appending
        </div>
        <div class="form-group">
            {{Form::label('note','Notes')}}
            {{Form::text('note', $product->note,array('class' => 'form-control'))}}
        </div>

        {{Form::submit('Update', array('class' => 'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>
@stop