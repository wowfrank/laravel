@extends('layouts.blog')
@section('content')
<style>
.content-section {
		margin-top: 15px;
		padding-top: 10px;
}
</style>

<div class="content-section" id="portfolio">
    <div class="container">
        <div class="row">
            @foreach($posts as $blog)
                <div class="portfolio-item col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/images/uploads/gallery/{{ $blog->page_image }}" alt="">
                        <div class="portfolio-overlay">
                            <h3><a href="/blog/{{ $blog->slug }}" id="blogTitle" >
                                            {{ $blog->subtitle }}</a></h3>
                            <p style="margin: 0 0 5px;">{!! str_limit(strip_tags($blog->content_raw), $limit = 150, $end = '...') !!}</p>
                            <a href="/images/uploads/gallery/{{ $blog->page_image }}" data-rel="lightbox" class="expand">
                                <i class="fa fa-search"></i>
                            </a>
                        </div> <!-- /.portfolio-overlay -->
                    </div> <!-- /.portfolio-thumb -->
                </div> <!-- /.portfolio-item -->
            @endforeach
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /#portfolio -->
@stop