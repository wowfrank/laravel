@extends('layouts.message')

@section('styles')
<style>
.content-section {
		margin-top: 15px;
		padding-top: 10px;
}
/* Spotlight */

.spotlight {
	display: -moz-flex;
	display: -webkit-flex;
	display: -ms-flex;
	display: flex;
	-moz-align-items: center;
	-webkit-align-items: center;
	-ms-align-items: center;
	align-items: center;
	margin: 0 0 2em 0;
}

.spotlight .image {
	width: 30%;
	border-radius: 100%;
	margin: 0 3em 0 0;
	display: block;
}

	.spotlight .image img {
		display: block;
		border-radius: 100%;
		width: 100%;
	}

.spotlight .content {
	width: 70%;
}

	.spotlight .content > :last-child {
		margin-bottom: 0;
	}

.spotlight:nth-child(2n) {
	-moz-flex-direction: row-reverse;
	-webkit-flex-direction: row-reverse;
	-ms-flex-direction: row-reverse;
	flex-direction: row-reverse;
}

	.spotlight:nth-child(2n) .image {
		margin: 0 0 0 3em;
	}

	.spotlight:nth-child(2n) .content {
		text-align: right;
	}

@media screen and (max-width: 736px) and (orientation: landscape) {

	.spotlight .image {
		margin: 0 2em 0 0;
	}

	.spotlight:nth-child(2n) .image {
		margin: 0 0 0 2em;
	}

}

@media screen and (max-width: 736px) and (orientation: portrait) {

	.spotlight {
		-moz-flex-direction: column !important;
		-webkit-flex-direction: column !important;
		-ms-flex-direction: column !important;
		flex-direction: column !important;
	}

		.spotlight .image {
			width: 100%;
			max-width: 60%;
			margin: 0 0 2em 0 !important;
		}

		.spotlight .content {
			width: 100%;
			text-align: center !important;
		}

}


/* Wrapper */

.wrapper {
	padding: 4.5em 0 2.5em 0 ;
	background-color: #ffffff;
	border-bottom: solid 2px #eeeeee;
}

.wrapper > .inner {
	margin-left: auto;
	margin-right: auto;
	width: 50em;
}

.wrapper > .inner.alt > * {
	border-top: solid 2px #eeeeee;
	margin-bottom: 0;
	margin-top: 3em;
	padding-top: 3em;
}

.wrapper > .inner.alt > *:first-child {
	border-top: 0;
	margin-top: 0;
	padding-top: 0;
}
</style>
@stop
@section('content')
<div class="content-section" id="portfolio">
    <div class="container">
    	<!-- show login if not auth -->
    	@if(Auth::user())
	    <div class="row">
	        <div class="col-md-6 col-md-offset-3">
	        	<h2>Login Using Social Sites</h2>
	            <a class="btn btn-primary" href="{{ route('social.login', ['baidu']) }}"><img src="{{ asset('images/baidu-login-short.png') }}" /></a>
	            <a class="btn btn-primary" href="{{ route('social.login', ['qq']) }}"><img src="{{ asset('images/qq-login-short.png') }}" /></a>
	            <a class="btn btn-primary" href="{{ route('social.login', ['weibo']) }}"><img src="{{ asset('images/weibo-login-short.png') }}" /></a>
	            <a class="btn btn-primary" href="{{ route('social.login', ['google']) }}">Google</a>
	        </div>
	    </div>
	    <!-- else show the form -->
	    @else
        <div class="row">
	        <div class="col-md-12">

				@include('admin.partials.success')
				@include('admin.partials.errors')

	            <form action="{{ route('message.store') }}" method="POST">
				    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				    <input type="hidden" name="msg_uid" value="{{ Auth::user()->id }}">
				    <textarea class="form-control" rows="3" name="msg_content" id="msg_content" autofocus placeholder="{{ trans('messages.Please tell us your feelings') }}"></textarea>
				    <button type="submit" class="btn btn-info btn-sm" name="sendMsg" id="sendMsg">{{ trans('messages.Send') }}</button>
				</form>
			</div>
        </div> <!-- /.row -->
        @endif
        <!-- endif -->

		<section id="one" class="wrapper">
			<div class="col-md-10">
				@if(count($messages) > 0)
			        @foreach($messages as $message)
				        <section class="spotlight">
							<div class="image"><img src="{{ $message->user->avatar }}" alt="" /></div>
							<div class="content">
								<h3> {{ $message->user->name}}</h3>
								<p> {{	$message->msg_content }}</p>
							</div>
						</section>
					@endforeach
				@endif
       		</div>
		</section>
    </div> <!-- /.container -->
</div> <!-- /#portfolio -->
@stop
