@if ($model->status=='activated')
<a href="#" class="badge badge-success border-info-600 rounded-round" title="{{ _lang('Activated') }}" data-popup="tooltip" data-placement="bottom" data-url="{{ route('admin.user.change',['value'=>'suspend','id'=>$model->id]) }}" data-id="{{$model->id}}" data-status="1" id="change_status">{{_lang('Active')}}</a>
@else
<a href="#" class="badge badge-danger border-info-600 rounded-round" title="{{ _lang('Suspend') }}" data-popup="tooltip" data-placement="bottom" data-url="{{ route('admin.user.change',['value'=>'activated','id'=>$model->id]) }}" data-id="{{$model->id}}" data-status="0" id="change_status">{{_lang('Suspend')}}</a>
@endif
