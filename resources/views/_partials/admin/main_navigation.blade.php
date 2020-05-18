<?php $index = 1;?>
<div class="card card-sidebar-mobile  noprint">
	<ul class="nav nav-sidebar" data-nav-type="accordion">
		{{-- @if(Request::segment($index + 1) == 'configuration')
		@include('_partials.admin.configuration', compact('index'))
		@else --}}
		<li class="nav-item">
			<a href="{{route('home')}}" class="nav-link{{ Request::is('home') ? ' active' : '' }}">
				<i class="icon-home4"></i>
				<span>
					{{_lang('Dashboard')}}
				</span>
			</a>
		</li>
		@if(auth()->user()->can('configuration.create'))
		<li class="nav-item">
			<a href="{{ route('admin.configuration') }}" class="nav-link{{ Request::is('admin/configuration') ? ' active' : '' }}">
				<i class="icon-cog spinner"></i>
				<span>
					{{_lang('Setting')}}
				</span>
			</a>
		</li>
		@endif

		 <li class="nav-item">
            <a href="{{ route('admin.profile') }}" class="nav-link{{ Request::is('admin/profile') ? ' active' : '' }}">
                <i class="icon-user"></i>
                <span>
                    {{_lang('Profile')}}
                </span>
            </a>
		</li>

		
       @if(auth()->user()->can('language.view'))
		<li class="nav-item">
			<a href="{{ route('admin.language') }}" class="nav-link{{ Request::is('admin/language') ? ' active' : '' }}">
				<i class="icon-stack-text"></i>
				<span>
					{{_lang('Language')}}
				</span>
			</a>
		</li>
		@endif

		@if(auth()->user()->can('user.view') || auth()->user()->can('role.view') )
		<li class="nav-item nav-item-submenu {{Request::is('admin/user*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('User Management')}}</span></a>

			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
			  @can('role.view')
				<li class="nav-item "><a href="{{ route('admin.user.role') }}" class="nav-link {{Request::is('admin/user/role*') ? 'active':''}}">{{_lang('Role & Permission')}}</a></li>
			  @endcan
			  @can('user.view')
				<li class="nav-item "><a href="{{ route('admin.user.index') }}" class="nav-link {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}">{{_lang('user manage')}}</a></li>
			  @endcan

			</ul>
		</li>
		@endif

		{{-- @endif --}}
	</ul>
</div>
