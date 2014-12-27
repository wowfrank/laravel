<div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('product') }}">Laravel</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Sentry::check())
                    	<li>{{ HTML::link('product', 'Product', array()) }}</li>
                    	<li>{{ HTML::link('product/create', 'Create Product', array()) }}</li>
                        <li>{{ HTML::link('order', 'Order', array()) }}</li>
                        <li>{{ HTML::link('order/create', 'Create Order', array('id' => 'create-order')) }}</li>
                        <li>{{ HTML::link('logout', 'Log Out', array()) }}</li>
                    @else
                        <li>{{ HTML::link('login', 'Login', array()) }}</li>
                        <li>{{ HTML::link('register', 'Register', array()) }}</li>
                    @endif
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <script type="text/javascript">
        $(function()
        {
            $('#create-order').click(function(e)
            {
                e.preventDefault();

                if( $('input[class="checkbox-class"]:checked').length > 0 ) 
                {
                    var dataString = JSON.stringify($('input[class="checkbox-class"]:checked').serializeArray());
                    var f = jQuery("<form>", { action: "{{ URL::to('order/create') }}", method: 'post' });

                    f.append(
                        $("<input>", { type: "hidden", name: "dataString", value: dataString })
                    );
                    $(document.body).append(f);
                    f.submit();
                } else {
                    //if nothing has been checked, prompt error message
                    alert('Please choose products that you want to add to order!');
                }

                return false;
            });
        });

    </script>
</div>