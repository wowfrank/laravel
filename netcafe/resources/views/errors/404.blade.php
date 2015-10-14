@extends('layouts.blog')

@section('content')
	<main id="main">
		<div class="container">
			<div class="row topspace">
				<div class="col-sm-8 col-sm-offset-2">	
	 				<article class="post">
						<header class="entry-header">
	 						<h1 class="entry-title"><a href='#' style='text-decoration: none;' class='disabled'>{{ trans('messages.404 NOT FOUND') }}</a></h1>
	 						<span class="meta">
								<a href="/" class="btn btn-info pull-left" role="button">{{ trans('messages.Netcafe') }} </a>
								<a href="/blog" class="btn btn-info pull-right" role="button">{{ trans('messages.Enter Blog') }} </a>
							</span>
	 					</header>
	 				</article>
	 			</div>
	 		</div>
	 	</div>
	 </main>
@stop