<div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('product') }}">Laravel</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Sentry::check())
                        <li> {{ HTML::link('balance', trans('message.Balance'), []) }} </li>
                    	<li> {{ HTML::link('product', trans('message.Product'), []) }} </li>
                    	<li> {{ HTML::link('product/create', trans('message.Create Product'), []) }} </li>
                        <li> {{ HTML::link('order', trans('message.Order'), []) }} </li>
                        <li> {{ HTML::link('qrcodes', trans('message.QrCode'), [] ) }}
                        <li> {{ HTML::link('logout', 'Log Out', []) }} </li>
                    @else
                        <li> {{ HTML::link('login', 'Login', []) }} </li>
                        <li> {{ HTML::link('register', 'Register', []) }} </li>
                    @endif
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</div>