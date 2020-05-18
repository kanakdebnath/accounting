@if(auth()->user()->can('user.update') || auth()->user()->can('user.delete') )
<img src="{{ asset('asset/ajaxloader.gif') }}" id="delete_loading_{{$model->id}}" style="display: none;">
<div class="list-icons" id="action_menu_{{$model->id}}">
	<div class="dropdown">
		<a href="#" class="list-icons-item" data-toggle="dropdown">
			<i class="icon-menu9"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			@can('user.update')
			<a class="dropdown-item" href="{{ route('admin.user.edit',$model->id) }}"><i class="icon-pencil7"></i> {{_lang('Edit')}}</a>
			@endcan
			@can('user.delete')
			<span class="dropdown-item" id="delete_item" data-id="{{ $model->id }}" data-url="{{ route('admin.user.delete',$model->id) }}"><i class="icon-trash"></i> {{_lang('Remove')}} </button></span>
			@endcan

		</div>
	</div>
</div>
@endif