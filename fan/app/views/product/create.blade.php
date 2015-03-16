@extends('layouts.product')

@section('body')
@if($errors->any())
    <div>
        <ul>
            {{ implode('', $errors->all('<li>:message</li>'))}}
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2>Create A Product</h2>
        {{ Form::open(array('route' => array('product.store'), 'method' => 'post')) }}
        <div class="form-group">
            {{ Form::label('category',trans('message.Category')) }}
            {{ Form::select('category_id', $categoryList, null, array('class' => 'form-control')) }}
            <!-- {{Form::text('first_name', null,array('class' => 'form-control'))}} -->
        </div>
        <div class="form-group">
            {{ Form::label('cname',trans('message.Chinese Name')) }}
            {{ Form::text('cname', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('ename',trans('message.English Name')) }}
            {{ Form::text('ename', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('brand',trans('message.Brand Name')) }}
            {{ Form::text('brand', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('unit',trans('message.Unit')) }}
            {{Form::text('unit', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{ Form::label('suggest_price', trans('message.Suggest Price')) }}
            {{ Form::text('suggest_price', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('retail_lowest', trans('message.Retail Lowest')) }}
            {{ Form::text('retail_lowest', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description',trans('message.Description')) }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('gross_weight',trans('message.Gross Weight')) }}
            {{ Form::text('gross_weight', null, array('class' => 'form-control')) }}
        </div>
        <!-- <div class="form-group">
            {{Form::label('item_no','item_no')}}
            {{Form::text('item_no', null, array('class' => 'form-control'))}}
        </div> -->
        <div class="form-group">
            {{ Form::label('note',trans('message.Notes')) }}
            {{ Form::text('note', null,array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('status', trans('message.Status')) }}
            <!-- {{Form::text('status', null, array('class' => 'form-control'))}} -->
            {{ Form::radio('status', '1', true, array('class' => 'form-control')) }} {{ trans('message.Approved') }}
            {{ Form::radio('status', '0', false, array('class' => 'form-control')) }} {{ trans('message.Appending') }}
        </div>

        {{ Form::submit(trans('message.Save'), array('class' => 'btn btn-primary')) }}
        {{ HTML::link('product', trans('message.Return'), ['class'=>'btn btn-info']) }}
        {{ Form::close() }}
    </div>
</div>
@stop
