<div class="content-section" id="services">
    <div class="container">
        <div class="row">
            <div class="heading-section col-md-12 text-center">
                <h2><a href="#" class="expend disabled">{{ trans('messages.Our Activities') }}</a></h2>
                <p>{{ trans("messages.Check out what's going on here") }}</p>
            </div> <!-- /.heading-section -->
        </div> <!-- /.row -->

        <div class="row">
            @foreach($activities as $key => $activity)
                <div class="col-md-3 col-sm-6">
                    <div class="service-item" id="service-{{ getTheRandNum(++$key, $activityRand) }}">
                        <div class="service-icon">
                            <i @if ($key%4 == 1) class="fa fa-file-code-o"
                                @elseif ($key%4 == 2) class="fa fa-paper-plane-o"
                                @elseif ($key%4 == 3) class="fa fa-institution"
                                @elseif ($key%4 == 0) class="fa fa-flask"
                                @endif></i>
                        </div> <!-- /.service-icon -->
                        <div class="service-content">
                            <div class="inner-service">
                               <h3>{{ $activity->title }} | <i>{{ $activity->status == '0' ? trans('messages.ONGOING') : trans('messages.COMPLETED') }}</i></h3>
                               <p>{!! $activity->description !!}</p> 
                            </div>
                        </div> <!-- /.service-content -->
                    </div> <!-- /#service-1 -->
                </div> <!-- /.col-md-3 -->
            @endforeach
            
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /#services -->