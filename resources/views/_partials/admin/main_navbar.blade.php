<div class="navbar navbar-expand-md navbar-dark fixed-top  noprint">
	<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
		<div class="navbar-brand navbar-brand-md">
			<a href="{{route('home')}}" class="d-inline-block">
				{!! getLogo() !!}
			</a>
		</div>

		<div class="navbar-brand navbar-brand-xs">
			<a href="{{route('home')}}" class="d-inline-block">
				{!! getSmLogo() !!}
			</a>
		</div>
	</div>
	<!-- Mobile controls -->
		<div class="d-flex flex-1 d-md-none">
			<div class="navbar-brand mr-auto">
				<a href="{{route('home')}}" class="d-inline-block">
					{!! getSmLogo() !!}
				</a>
			</div>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>

			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<!-- /mobile controls -->
	<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>
		</ul>
		<span class="navbar-text ml-md-3 mr-md-auto">
			<span class="badge bg-success">Online</span>
		</span>
		<ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ auth()->user()->getProfile()->photo ? asset('storage/logo/'.auth()->user()->getProfile()->photo) : asset('asset/global_assets/images/placeholders/user.jpg') }}" class="rounded-circle" alt="">
                    <span>{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a href="{{ route('admin.usershow') }}" class="dropdown-item"><i class="icon-user-plus"></i> @lang('menu.my_profile')</a>
                    <a href="{{ route('admin.password') }}" class="dropdown-item"><i class="icon-lock4"></i> @lang('menu.change_password')</a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <a href="#" class="dropdown-item"><i class="icon-cog5"></i> @lang('menu.account_setting')</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" id="logout" data-url='{{ route('logout') }}'>
                        <i class="icon-switch2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
	</div>
</div>
