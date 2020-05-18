{!! Form::open(['route' => 'install.user', 'class' => 'form-validate-jquery', 'id' => 'install_form', 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3" id="form_field">
    <legend class="text-uppercase font-size-sm font-weight-bold">Login Details <span class="text-danger">*</span> <small> All Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('first_name', 'First Name' , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('step_3', 'step_3') }}
                {{ Form::text('first_name', Null, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('last_name', 'Last Name' , ['class' => 'col-form-label required']) }}
                {{ Form::text('last_name', Null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('contact_number','Contact Number' , ['class' => 'col-form-label required']) }}
                {{ Form::text('contact_number', Null, ['class' => 'form-control', 'placeholder' => 'Contact Number', 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('email','Email' , ['class' => 'col-form-label required']) }}
                {{ Form::text('email', Null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('username', 'Username' , ['class' => 'col-form-label required']) }}
                {{ Form::text('username', Null, ['class' => 'form-control', 'placeholder' =>  'Username', 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('password', 'Password' , ['class' => 'col-form-label required']) }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' =>  'Password', 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12 ">
            <button type="submit" class="btn btn-primary ml-3l" id="submit" data-url="{{ route('install.settings') }}" style="width: 100%;" >Submit</button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}