@extends('layouts.blog', [
	'title' => $post->subtitle,
	'meta_description' => $post->meta_description ? $post->meta_description : config('blog.description'),
])
@section('content')

	{{-- The Post --}}
	<main id="main">
		<div class="container">
			<div class="row topspace">
				<div class="col-sm-8 col-sm-offset-2">	
	 				<article class="post">
						<header class="entry-header">
	 						<h1 class="entry-title"><a href='#' style='text-decoration: none;' class='disabled'>{{ $post->subtitle }}</a></h1>
	 						<div class="entry-meta"> 
	 							<span class="posted-on"><time class="entry-date published">{{ $post->published_at->format('Y-m-d') }} 
	 							@if ($post->tags->count())
									{{ trans('messages.in') }}:
									{!! join(', ', $post->tagLinks()) !!}
								@endif
								</time></span>			
	 						</div> 
						</header> 
						<div class="entry-content"> 
							{!! $post->content_html !!}
						</div> 
					</article><!-- #post-## -->

				</div> 
			</div> <!-- /row post  -->
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<span class="meta">
						<a href="#" onclick="window.history.back();" class="btn btn-info" role="button">{{ trans('messages.Return') }} </a>
					</span>
				</div>
			</div>

			<div class="clearfix"></div>

		</div>	<!-- /container -->
	</main>
	
	<hr>
	<div class="container">
	    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
	        @include('blog.partials.disqus')
	    </div>
	</div>

@stop

