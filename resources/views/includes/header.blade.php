@php
	$headerClass = (!empty($headerInverse)) ? 'navbar-inverse ' : 'navbar-default ';
	$headerMenu = (!empty($headerMenu)) ? $headerMenu : '';
	$headerMegaMenu = (!empty($headerMegaMenu)) ? $headerMegaMenu : '';
	$headerTopMenu = (!empty($headerTopMenu)) ? $headerTopMenu : '';
@endphp
<!-- begin #header -->
<div id="header" class="header {{ $headerClass }}">
	<!-- begin navbar-header -->
	<div class="navbar-header">
{{--		@if ($sidebarTwo)--}}
{{--		<button type="button" class="navbar-toggle pull-left" data-click="right-sidebar-toggled">--}}
{{--			<span class="icon-bar"></span>--}}
{{--			<span class="icon-bar"></span>--}}
{{--			<span class="icon-bar"></span>--}}
{{--		</button>--}}
{{--		@endif--}}
        <button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
		<a href="/" class="navbar-brand"><strong>Parvulario</strong></a>
{{--		@if ($headerMegaMenu)--}}
{{--			<button type="button" class="navbar-toggle pt-0 pb-0 mr-0" data-toggle="collapse" data-target="#top-navbar">--}}
{{--				<span class="fa-stack fa-lg text-inverse">--}}
{{--					<i class="far fa-square fa-stack-2x"></i>--}}
{{--					<i class="fa fa-cog fa-stack-1x"></i>--}}
{{--				</span>--}}
{{--			</button>--}}
{{--		@endif--}}
{{--		@if (!$sidebarHide && $topMenu)--}}
{{--			<button type="button" class="navbar-toggle pt-0 pb-0 mr-0 collapsed" data-click="top-menu-toggled">--}}
{{--				<span class="fa-stack fa-lg text-inverse">--}}
{{--					<i class="far fa-square fa-stack-2x"></i>--}}
{{--					<i class="fa fa-cog fa-stack-1x"></i>--}}
{{--				</span>--}}
{{--			</button>--}}
{{--		@endif--}}
{{--		@if (!$sidebarHide && !$headerTopMenu)--}}
{{--		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">--}}
{{--			<span class="icon-bar"></span>--}}
{{--			<span class="icon-bar"></span>--}}
{{--			<span class="icon-bar"></span>--}}
{{--		</button>--}}
{{--		@endif--}}
{{--		@if ($headerTopMenu)--}}
{{--			<button type="button" class="navbar-toggle" data-click="top-menu-toggled">--}}
{{--				<span class="icon-bar"></span>--}}
{{--				<span class="icon-bar"></span>--}}
{{--				<span class="icon-bar"></span>--}}
{{--			</button>--}}
{{--		@endif--}}
	</div>
	<!-- end navbar-header -->

{{--	@includeWhen($headerMegaMenu, 'includes.header-mega-menu')--}}

	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
        @yield('header-nav')
{{--		<li class="navbar-form">--}}
{{--			<form action="" method="POST" name="search_form">--}}
{{--				<div class="form-group">--}}
{{--					<input type="text" class="form-control" placeholder="Enter keyword" />--}}
{{--					<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>--}}
{{--				</div>--}}
{{--			</form>--}}
{{--		</li>--}}
		
<li class="dropdown navbar-user">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<img src="/assets/img/user/user-13.jpg" alt="" />
		<span class="d-none d-md-inline">
			@php
				echo session('usuario')
			@endphp
		</span> <b class="caret"></b>
	</a>
	<div class="dropdown-menu dropdown-menu-right">
		<a href="{{ url('/logout')}}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>

				<form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
					@csrf
				</form>
	</div>
</li>
{{--		@if($sidebarTwo)--}}
{{--		<li class="divider d-none d-md-block"></li>--}}
{{--		<li class="d-none d-md-block">--}}
{{--			<a href="javascript:;" data-click="right-sidebar-toggled" class="f-s-14">--}}
{{--				<i class="fa fa-th"></i>--}}
{{--			</a>--}}
{{--		</li>--}}
{{--		@endif--}}
	</ul>
	<!-- end header navigation right -->
</div>
<!-- end #header -->
