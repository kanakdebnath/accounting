{!! Form::open(['route' => 'install.database', 'class' => 'form-validate-jquery', 'id' => 'install_form', 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3" id="form_field">
	<legend class="text-uppercase font-size-sm font-weight-bold">Database Configuration <span class="text-danger">*</span> <small> All Fields Are Required </small></legend>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				{{ Form::label('db_host', 'Hostname' , ['class' => 'col-form-label required']) }}
				{{ Form::hidden('step_2', 'step_2') }}
				{{ Form::text('db_host', 'localhost', ['class' => 'form-control', 'placeholder' => 'Hostname', 'required' => '']) }}
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				{{ Form::label('db_database','Database' , ['class' => 'col-form-label required']) }}
				{{ Form::text('db_database', Null, ['class' => 'form-control', 'placeholder' => 'Database', 'required' => '']) }}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				{{ Form::label('db_username', 'Database Username' , ['class' => 'col-form-label required']) }}
				{{ Form::text('db_username', Null, ['class' => 'form-control', 'placeholder' =>  'Database Username', 'required' => '']) }}
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				{{ Form::label('db_password', 'Database Password' , ['class' => 'col-form-label']) }}
				{{ Form::text('db_password', Null, ['class' => 'form-control', 'placeholder' =>  'Database Password']) }}
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-lg-12 ">
			<button type="submit" class="btn btn-primary ml-3l" id="submit" data-url="{{ route('install.user') }}" style="width: 100%;" >Submit</button>

		</div>
	</div>
</fieldset>
{!! Form::close() !!}