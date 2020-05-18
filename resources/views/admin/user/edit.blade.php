@extends('layouts.app', ['title' => _lang('user manage'), 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('user manage')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('user manage')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		{{-- <div class="text-center">
			<img src="{{ asset('asset/table_loader.gif') }}" id="table_loading" width="100px">
		</div> --}}
    {!! Form::open(['route' => 'admin.user.update', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
    @method('PUT');
    <input type="hidden" name="id" value="{{$user->id}}">
    <fieldset class="mb-3" id="form_field">
     <div class="row">
     	<div class="col-md-2">
     	  <div class="form-group">
            {{ Form::label('surname', _lang('Prefix') , ['class' => 'col-form-label required']) }}

            {{ Form::text('surname', $user->surname, ['class' => 'form-control', 'placeholder' => 'Dr/Mr/Mrs','required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-5">
     	  <div class="form-group">
            {{ Form::label('first_name', _lang('First Name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'placeholder' => _lang('First Name'),'required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-5">
     	  <div class="form-group">
            {{ Form::label('last_name', _lang('last Name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => _lang('last Name'),'required'=>'']) }}
          </div>
     	</div>
     </div>

     <div class="row">
     	<div class="col-md-4">
     		<div class="form-group">
            {{ Form::label('email', _lang('Email') , ['class' => 'col-form-label required']) }}

            {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => _lang('Email'),'required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-4">
        <div class="form-group">
          {{ Form::label('role', _lang('Role Name') , ['class' => 'col-form-label required']) }}
            {!! Form::select('role', $roles, $user->roles->first()->id, ['class' => 'form-control select', 'data-placeholder' => 'Select A Role']); !!}
        </div>
      </div>

      <div class="col-md-4">
     		<div class="form-group">
            {{ Form::label('username', _lang('Username') , ['class' => 'col-form-label required']) }}

            {{ Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => _lang('Username'),'required'=>'']) }}
          </div>
     	</div>
     </div>

     <div class="row">
     	<div class="col-md-6">
     		<div class="form-group">
            {{ Form::label('password', _lang('Password') , ['class' => 'col-form-label required']) }}

            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => _lang('Password'),'required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-6">
     	 <div class="form-group">
            {{ Form::label('password_confirmation', _lang('Confirm Password') , ['class' => 'col-form-label required']) }}

            {{ Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => _lang('Confirm Password'),'required'=>'']) }}
          </div>
     	</div>
     </div>
         @can('user.update')
		<div class="text-right">
		    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update User')}}<i class="icon-arrow-right14 position-right"></i></button>
		    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		   </div>
           @endcan
     <fieldset class="mb-3" id="form_field">
    {!!Form::close()!!}
	</div>
</div>

<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/pages/user.js') }}"></script>
<!-- /theme JS files -->
@endpush