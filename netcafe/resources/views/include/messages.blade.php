<div class="content-section" id="our-messages">
    <div class="container">        
        <div class="row">
            <div class="heading-section col-md-12 text-center">
                <h2><a href="/message/" class="expend">{{ trans('messages.Our Messages') }}</a></h2>
                <p>{{ trans('messages.Check out our messages') }}</p>
            </div> <!-- /.heading-section -->
        </div> <!-- /.row -->
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <ul class="list-group">
                    @if(count($messages) > 0)
                        @foreach($messages as $message)
                        <li class="list-group-item"> {!! str_limit(strip_tags($message->msg_content), $limit = 70, $end = '...') !!} <span class="badge">{{ $message->created_at->format('Y-m-d g:ia') }}</span></li>
                        @endforeach
                    @else
                        <li class="list-group-item"> {{ trans('messages.Not Found') }}</li>
                    @endif
                </ul>
            </div> <!-- /.col-md-8 -->
            <div class="col-md-4 col-sm-6">
                <ul class="progess-bars">
                    <li>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">{{ trans('messages.Cafe Service') }} 90%</div>
                        </div>
                    </li>
                    <li>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">{{ trans('messages.Cafe Hygiene') }} 75%</div>
                        </div>
                    </li>
                    <li>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;">{{ trans('messages.Cafe Environment') }} 68%</div>
                        </div>
                    </li>
                    <li>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">{{ trans('messages.Cafe Hardware') }} 95%</div>
                        </div>
                    </li>
                    <li>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">{{ trans('messages.Cafe Price') }} 95%</div>
                        </div>
                    </li>
                </ul>
            </div> <!-- /.col-md-4 -->
        </div> <!-- /.row -->
    </div>
</div>