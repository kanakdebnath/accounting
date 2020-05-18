@extends('layouts.app', ['title' => 'role', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('Role & Permission')}}</span>
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
		<h5 class="card-title">{{_lang('Role & Permission')}}
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
    {!! Form::open(['route' => 'admin.user.role.update', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
        <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            {{ Form::label('name',  _lang('Role Name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('name', $role->name, ['class' => 'form-control', 'placeholder' =>  _lang('Role Name'),'required'=>'']) }}
            <input type="hidden" name="id" value="{{$role->id}}">
          </div>
        </div>
        </div>
        <div class="row">
        <h2>{{_lang('Permission')}}</h2>
	     <table class="table table-bordered">
	      @foreach (split_name($permissions) as $key => $element)
	 		<tr>
	 			<td rowspan ="{{count($element)+1}}">{!! $key !!}</td>
	 			<td rowspan="{{count($element)+1}}">
	 			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input select_all" id="select_all_{{$key}}" data-id="{{$key}}">
				<label class="custom-control-label" for="select_all_{{$key}}">{{_lang('Select All')}}</label>
			    </div>
	 			</td>
	 		</tr>
	      	 @foreach ($element as $per)
	      	 <tr>

	      	 	<td>
	      	 	 <div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input {{$key}}" id="{{$per}}" multiple="multiple" name="permissions[]" value="{{$per}}" {{in_array($per, $role_permissions)?'checked':''}}>
				<label class="custom-control-label" for="{{$per}}">{{tospane($per)}}</label>
			    </div>
	      	 	
	      	 	</td>
	      	 </tr>
	      	@endforeach
	       @endforeach
	     </table>
        </div>
        @can('role.update')
		 <div class="text-right">
		    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update Permission')}}<i class="icon-arrow-right14 position-right"></i></button>
		    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		   </div>
		 @endcan

    {!!Form::close()!!}
	</div>
</div>


<!-- /basic initialization -->
@stop
@push('scripts')
<script src="{{ asset('js/role.js') }}"></script>
<!-- /theme JS files -->
<script>
	$(document).on('click','.select_all',function(){
		var id =$(this).data('id');
		if (this.checked) {
			$("."+id).prop('checked', true);
		} else{
			$("."+id).prop('checked', false);
		}
	});
</script>
@endpush