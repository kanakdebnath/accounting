{{-- 
<img src="{{ asset('asset/ajaxloader.gif') }}" id="delete_loading_{{$model->id}}" style="display: none;">
<div class="list-icons" id="action_menu_{{$model->id}}">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
		
			<a class="dropdown-item" href=""><i class="icon-eye"></i> ভিউ</a>

			<a class="dropdown-item" href=""><i class="icon-pencil7"></i> এডিট</a>
	
			<span class="dropdown-item" id="delete_item" data-id="{{ $model->id }}" data-url=""><i class="icon-trash"></i> ডিলিট </button></span>

		</div>
	</div>
</div> --}}
@if ($model->name!=='Super Admin')
@if(auth()->user()->can('role.update') || auth()->user()->can('role.delete') )
@can('role.upadte')
<a href="{{ route('admin.user.role.edit',$model->id) }}" class="btn btn-info" title="{{ _lang('Edit Permission') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-pencil7"></i></a>
@endcan
@can('role.delete')
<a href="#" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.user.role.delete',$model->id) }}" class="btn btn-danger" title="{{ _lang('Delete Permission') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-trash"></i></a>
@endcan
@endif
@endif
