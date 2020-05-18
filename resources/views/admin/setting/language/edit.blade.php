@extends('layouts.app', ['title' => 'Language', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('Language')}}/{{$id}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
 <div class="row">
   	<div class="col-md-12">
	 <div class="card">
	   <div class="card-body">
	   {!! Form::open(['route' => ['admin.language.update',$id], 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
		<fieldset class="mb-3" id="form_field">
	@method('patch');
		<div class="row">
		@foreach($language as $key=>$lang)
		  <div class="col-md-6">
		  {{ Form::label('language_name', ucwords($key) , ['class' => 'col-form-label required']) }}
		  <input type="text" class="form-control" name="language[{{ str_replace(' ','_',$key) }}]" value="{{ $lang }}" required>
		  </div>
        @endforeach
		</div>
		@can('language.update')
		  <div class="text-right">
		    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Translation')}}<i class="icon-arrow-right14 position-right"></i></button>
		    <button type="button" class="btn btn-link" id="submiting" style="display: none;">Processing <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		   </div>
		   @endcan
		</fieldset>
		{!!Form::close()!!}
	   </div>
	 </div>
   </div>
 </div>
<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/setting.js') }}"></script>
<!-- /theme JS files -->
@endpush