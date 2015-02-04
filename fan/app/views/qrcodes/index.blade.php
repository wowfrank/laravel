@extends('layouts.product')

@section('body')
@if (Session::has('message'))
 	<div>{{ Session::get('message') }}</div>
@endif
	<div class="list-group">
		<a class="list-group-item active">
			<h4 class="list-group-item-heading">QrCode Verification</h4>
		</a>
		{{ Form::open(['route' => 'qrcodes.check', 'method' => 'post', 'id'=>'frm-verify-qrcode']) }}
		<div class="form-group col-md-4 col-md-offset-4">
            {{ Form::text('encrypted_str', null, array('class' => 'form-control')) }}
            <!-- {{Form::text('first_name', null,array('class' => 'form-control'))}} -->
        </div>
        {{ Form::submit(trans('message.Decrypt QrCode'), ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

		<a class="list-group-item active">
			<h4 class="list-group-item-heading">QrCode List</h4>
		</a>
		
		<!-- @foreach ($qrStrs as $qrStr) -->
			<!-- <div class="col-md-1 col-md-offset-1"> -->
				<!-- {{ $qrStr }} -->
				<!-- <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->errorCorrection('H')->encoding('UTF-8')->size(100)->generate($qrStr)); }}" /> -->
			<!-- </div> -->
		<!-- @endforeach -->
		
	</div>
	<div class="clearfix"></div>


	<script>
		$( document ).ready( function( $ ) {
	        $('#frm-verify-qrcode').on('submit', function()
	        {
	        	if($("input[name='encrypted_str']").val() == '') alert('Please enter code you get');
	        	else
		        	$.post(
		        		$(this).prop('action'), {
		        			'_token': $(this).find("input[name='_token']").val(),
		        			'encrypted_str': encodeURIComponent($(this).find("input[name='encrypted_str']").val())
		        										.replace(/!/g, '%21')
														.replace(/'/g, '%27')
														.replace(/\(/g, '%28')
														.replace(/\)/g, '%29')
														.replace(/\*/g, '%2A')
														.replace(/%20/g, '+')
		        		}, function(data) {
		        			alert(data.msg);
		        		}
		        	);
	            return false;
	        });
	    })
	</script>
@stop


