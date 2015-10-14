
<div class="content-section" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="heading-section col-md-12 text-center">
                <h2><a href="/blog/" class="expend">{{ trans('messages.Our Blogs') }}</a></h2>
                <p>{{ trans('messages.What we have done so far') }}</p>
            </div> <!-- /.heading-section -->
        </div> <!-- /.row -->
        <div class="row">
            @foreach($blogs as $blog)
                <div class="portfolio-item col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/images/uploads/gallery/{{ $blog->page_image }}" alt="">
                        <div class="portfolio-overlay">
                            <h3><a id="blogTitle" href="/blog/{{ $blog->slug }}"> 
                                    {{ $blog->subtitle }}</a></h3>
                            <p>{!! str_limit(strip_tags($blog->content_raw), $limit = 150, $end = '...') !!}</p>
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