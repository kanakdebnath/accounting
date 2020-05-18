{!! Form::open(['route' => 'admin.language.create', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3" id="form_field">
 <div class="form-group">
	{{ Form::label('language_name', _lang('language name') , ['class' => 'col-form-label required']) }}
	{{ Form::text('language_name', get_option('language name'), ['class' => 'form-control', 'placeholder' => _lang('language name'),'required'=>'']) }}
</div>
  @can('language.create')
   <div class="text-right">
    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create Language')}}<i class="icon-arrow-right14 position-right"></i></button>
    <button type="button" class="btn btn-link" id="submiting" style="display: none;">Processing <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

   </div>
   @endcan
</fieldset>
{!!Form::close()!!}