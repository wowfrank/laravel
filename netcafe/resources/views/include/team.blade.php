<div class="content-section" id="our-team">
    <div class="container">
        <div class="row">
            <div class="heading-section col-md-12 text-center">
                <h2><a href="#" class="expend disabled">{{ trans('messages.Our Team') }}</a></h2>
                <p>{{ trans('messages.Meet our people and about our company') }}</p>
            </div> <!-- /.heading-section -->
        </div> <!-- /.row -->
        <div class="row">
            @foreach($teams as $member)
            <div class="team-member col-md-3 col-sm-6">
                <div class="member-thumb">
                    <img src="images/uploads/team/{{ $member->imgname }}" alt="">
                    <div class="team-overlay">
                        <h3>{{ $member->nickname }}</h3>
                        <span>{{ $member->duty }}</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div> <!-- /.team-overlay -->
                </div> <!-- /.member-thumb -->
            </div> <!-- /.team-member -->
            @endforeach
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /#our-team -->