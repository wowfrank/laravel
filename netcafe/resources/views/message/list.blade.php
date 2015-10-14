@extends('layouts.message')
@section('content')
<style>
.content-section {
		margin-top: 15px;
		padding-top: 10px;
}
</style>
<div class="content-section" id="portfolio">
    <div class="container">
    	<!-- show login if not auth -->
    	@if(!Auth::user())
	    <div class="row">
	        <div class="col-md-6 col-md-offset-3">
	        	<h2>Login Using Social Sites</h2>
	            <a class="btn btn-primary" href="{{ route('social.login', ['baidu']) }}">Baidu</a>
	            <a class="btn btn-primary" href="{{ route('social.login', ['qq']) }}">QQ</a>
	            <a class="btn btn-primary" href="{{ route('social.login', ['weibo']) }}">Weibo</a>
	        </div>
	    </div>
	    <!-- else show the form -->
	    @else
        <div class="row">
	        <div class="col-md-12">
	        	<div class="alert alert-danger hidden" id='sendMsg-errors'>
					<strong>Whoops!</strong>
					{{ trans('messages.There were some problems with your input.') }}<br><br>
					<ul></ul>
				</div>
				<div class="alert alert-success hidden" id='sendMsg-done'>
					<strong><i class="fa fa-check-circle fa-lg fa-fw"></i> {{ trans('messages.Success') }}. </strong>
					{{ Session::get('success') }}
				</div>
	            <form action="#" method="POST">
				    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				    <textarea class="form-control" rows="3" name="msg_content" id="msg_content" autofocus placeholder="{{ trans('messages.Please tell us your feelings') }}"></textarea>
				    <button type="button" class="btn btn-info btn-sm" name="sendMsg" id="sendMsg">{{ trans('messages.Send') }}</button>
				</form>
			</div>
        </div> <!-- /.row -->
        @endif
        <!-- endif -->

        @foreach($messages as $message)
        <div class="row">
        	<div class="col-md-12" style="border: 1px solid gray">
        		{{ $message->msg_content }}
        	</div>
        </div>
        @endforeach
    </div> <!-- /.container -->
</div> <!-- /#portfolio -->
@stop

@section('scripts')
<script>
	(function($){
		$('#sendMsg').click(function(e){
			e.preventDefault();
			$('.alert').addClass('hidden');
			$('#sendMsg-errors ul').empty();

			$(this).attr('disabled', 'disabled');
			$.ajax({
				url	:"{{route('message.store')}}",
				type:'POST',
				data:{'_token': $('input[name=_token]').val(), 'msg_content': $('textarea[name=msg_content').val()},
				success: function( data ){
                    //$('#response pre').html( data );
                    $('#sendMsg').removeAttr('disabled');
                    $('#sendMsg-done').removeClass('hidden');

                },
                statusCode: {
			        422: function(data) {
			            // Something went wrong (error in data serverside), re-enable send button
			            $('#sendMsg').removeAttr('disabled');
			            $('#sendMsg-errors').removeClass('hidden');

					    // Errors...
					    var errors = $.parseJSON(data.responseText);
					    $.each(errors, function(index, value) {
					        $('#sendMsg-errors ul').append($('<li>').append(value));
					    });
			        }
			    }
			});
		});
		
	})(jQuery);
</script>
@stop