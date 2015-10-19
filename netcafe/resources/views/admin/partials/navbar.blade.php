<ul class="nav navbar-nav">
	<li><a href="/">{{ trans('messages.Netcafe Home') }}</a></li>
	@if (Auth::check())
		<li @if (Request::is('admin/post*')) class="active" @endif>
			<a href="/admin/post">{{ trans('messages.Posts') }}</a>
		</li>
		<li @if (Request::is('admin/tag*')) class="active" @endif>
			<a href="/admin/tag">{{ trans('messages.Tags') }}</a>
		</li>
		<li @if (Request::is('admin/upload*')) class="active" @endif>
			<a href="/admin/upload">{{ trans('messages.Uploads') }}</a>
		</li>
		<li @if (Request::is('admin/cover*')) class="active" @endif>
			<a href="/admin/cover">{{ trans('messages.Covers') }}</a>
		</li>
		<li @if (Request::is('admin/activity*')) class="active" @endif>
			<a href="/admin/activity">{{ trans('messages.Activites') }}</a>
		</li>
		<li @if (Request::is('admin/team*')) class="active" @endif>
			<a href="/admin/team">{{ trans('messages.Teams') }}</a>
		</li>
	@endif
</ul>

<ul class="nav navbar-nav navbar-right">
	@if (Auth::guest())
		<li><a href="/auth/login">Login</a></li>
	@else
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="/auth/logout">Logout</a></li>
			</ul>
		</li>
	@endif
</ul>