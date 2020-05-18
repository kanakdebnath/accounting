@extends('layouts.app', ['title' => 'language', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> Language</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">{{_lang('Language initialization')}}</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
					 <h5 class="panel-title">{{_lang('Create')}}
					 @can('language.create')
					  <button type="button" class="btn btn-info" id="content_managment" data-url ="{{ route('admin.language.create') }}"><i class="icon-stack-plus mr-2"></i>{{_lang('Create')}}</button>
					  @endcan
					  </h5>
					</div>

					<table class="table datatable-button-init-basic">
						<thead>
							<tr>
								<th>{{_lang('Language')}}</th>
								<th>{{_lang('Edit Tarnslation')}}</th>
								<th>{{_lang('Remove')}}</th>
								
							</tr>
						</thead>
						<tbody>
						 @foreach(get_language_list() as $language)
							<tr>
								<td>{{ ucwords($language) }}</td>
								<td>
								@can('language.update')
								<a href="{{ route('admin.language.edit',$language) }}" class="btn btn-info"><i class="icon-pencil7"></i>{{_lang('Translate')}}</a>
								@endcan
								</td>
								<td>
								@can('language.delete')
								<a href="#" class="btn btn-danger" id="delete_item" data-id ="{{$language}}" data-url="{{route('admin.language.delete',$language) }}"><i class="icon-trash"></i></a>
								@endcan
								</td>
								
							</tr>
						 @endforeach
						</tbody>
					</table>
				</div>
			
<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->

<script src="{{asset('asset/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('asset/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
<script src="{{asset('asset/global_assets/datatables_extension_buttons_init.js')}}"></script>
<script src="{{ asset('js/setting.js') }}"></script>
<!-- /theme JS files -->
@endpush