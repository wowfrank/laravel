@extends('layouts.main')

@section('body')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
        <h2>Login here</h2>
		{{ Form::open(array('url' => 'login', 'method' => 'post')) }}
		<div class="form-group">
		{{Form::label('email','Email')}}
		{{Form::text('email', null,array('class' => 'form-control'))}}
		</div>
        <div class="form-group">
		{{Form::label('password','Password')}}
		{{Form::password('password',array('class' => 'form-control'))}}
		</div>
		{{Form::submit('Login', array('class' => 'btn btn-primary'))}}
		{{ Form::close() }}
	</div>
</div>

@stop