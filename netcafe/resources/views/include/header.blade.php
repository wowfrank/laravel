<div class="site-slider">
    <div class="slider">
        <div class="flexslider">
            <ul class="slides">
                @foreach($covers as $cover)
                <li>
                    <div class="overlay"></div>
                    <img src="images/uploads/slider/{{$cover->name}}" alt="">
                    <div class="slider-caption visible-md visible-lg">
                        <h2> {{ $cover->title }} </h2>
                        <p> {{ $cover->subtitle }}</p>
                        @if ($cover->linktitle != '')
                            <a href="{{ $cover->link }}" class="slider-btn" target="_blank"> {{ $cover->linktitle }}</a>
                        @endif
                    </div>
                </li>
                @endforeach
                
            </ul>
        </div> <!-- /.flexslider -->
    </div> <!-- /.slider -->
</div> <!-- /.site-slider -->