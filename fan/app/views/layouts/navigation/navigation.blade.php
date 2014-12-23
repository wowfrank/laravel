<div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Laravel</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Sentry::check())
                    	<li>{{ HTML::link('product', 'Product', array('class'=>'btn btn-default')) }}</li>
                    	<li>{{ HTML::link('product/create', 'Create Product', array('class'=>'btn btn-default')) }}</li>
                        <li>{{ HTML::link('order', 'Order', array('class'=>'btn btn-default')) }}</li>
                        <li>{{ HTML::link('order/create', 'Create Order', array('class'=>'btn btn-default')) }}</li>
                        <li>{{ HTML::link('logout', 'Log Out', array('class'=>'btn btn-default')) }}</li>
                    @else
                        <li>{{ HTML::link('login', 'Login', array('class'=>'btn btn-default')) }}</li>
                        <li>{{ HTML::link('register', 'Register', array('class'=>'btn btn-default')) }}</li>
                    @endif
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</div>