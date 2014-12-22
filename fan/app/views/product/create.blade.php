@extends('layouts.product')

@section('body')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2>Register here</h2>
        {{ Form::open(array('route' => array('product.store'), 'method' => 'post')) }}
        <div class="form-group">
            {{Form::label('category','Category')}}
            {{Form::select('category_id', $categoryList, null, array('class' => 'form-control')) }}
            <!-- {{Form::text('first_name', null,array('class' => 'form-control'))}} -->
        </div>
        <div class="form-group">
            {{Form::label('cname','Chinese Name')}}
            {{Form::text('cname', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('ename','English Name')}}
            {{Form::text('ename', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('brand','Brand Name')}}
            {{Form::text('brand', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('unit','Unit')}}
            {{Form::text('unit', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('suggest_price','Suggest Price')}}
            {{Form::text('suggest_price', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('retail_lowest','Retail Lowest')}}
            {{Form::text('retail_lowest', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('description','Description')}}
            {{Form::text('description', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('gross_weight','Gross Weight')}}
            {{Form::text('gross_weight', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('item_no','item_no')}}
            {{Form::text('item_no', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('status','Status')}}
            <!-- {{Form::text('status', null, array('class' => 'form-control'))}} -->
            {{ Form::radio('status', '1', false, array('class' => 'form-control')) }} Approved
            {{ Form::radio('status', '0', true, array('class' => 'form-control')) }} Appending
        </div>
        <div class="form-group">
            {{Form::label('note','Notes')}}
            {{Form::text('note', null,array('class' => 'form-control'))}}
        </div>

        {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>
@stop