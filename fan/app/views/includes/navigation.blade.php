<div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('product') }}">Laravel</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Sentry::check())
                        <li>{{ HTML::link('balance', 'Balance', array()) }}</li>
                    	<li>{{ HTML::link('product', 'Product', array()) }}</li>
                    	<li>{{ HTML::link('product/create', 'Create Product', array()) }}</li>
                        <li>{{ HTML::link('order', 'Order', array()) }}</li>
                        <li>{{ HTML::link('logout', 'Log Out', array()) }}</li>
                    @else
                        <li>{{ HTML::link('login', 'Login', array()) }}</li>
                        <li>{{ HTML::link('register', 'Register', array()) }}</li>
                    @endif
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</div>