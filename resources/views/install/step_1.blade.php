{!! Form::open(['route' => 'install.server', 'class' => 'form-validate-jquery', 'id' => 'install_form', 'method' => 'POST']) !!}
<fieldset class="mb-3">
	<legend class="text-uppercase font-size-sm font-weight-bold">Server Requirements </legend>
	<div class="row">
		@foreach($requirements['server'] as $server)
		<div class="col-md-6">
			<div class="alert alert-{{ $server['type'] }} alert-styled-left alert-arrow-left alert-dismissible">
				<span class="font-weight-semibold">{{ $server['message'] }}</span>
			</div>
		</div>
		@endforeach
	</div>
	<legend class="text-uppercase font-size-sm font-weight-bold">Folder Requirements </legend>
	<div class="row">
		@foreach($requirements['folder'] as $folder)
		<div class="col-md-6">
			<div class="alert alert-{{ $folder['type'] }} alert-styled-left alert-arrow-left alert-dismissible">
				<span class="font-weight-semibold">{{ $folder['message'] }}</span>
			</div>
		</div>
		@endforeach
	</div>
	<div class="form-group row">
		<div class="col-lg-12 ">
			<button type="submit" class="btn btn-primary ml-3l" id="submit" data-url="{{ route('install.database') }}" style="width: 100%;" >Submit</button>
		</div>
	</div>
</fieldset>
{!! Form::close() !!}