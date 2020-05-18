{!! Form::open(['route' => 'install.settings', 'class' => 'form-validate-jquery', 'id' => 'install_form', 'method' => 'POST']) !!}
<fieldset class="mb-3">
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">Company Details <span class="text-danger">*</span> <small> All Fields Are Required </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('company_name', 'Company Name' , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('step_4', 'step_4') }}
                {{ Form::text('company_name', Null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('site_title','Site Title' , ['class' => 'col-form-label required']) }}
                {{ Form::text('site_title', Null, ['class' => 'form-control', 'placeholder' => 'Site Title', 'required' => '']) }}
            </div>
        </div>
    </div>
         <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('phone', 'Phone' , ['class' => 'col-form-label required']) }}
                {{ Form::text('phone', Null, ['class' => 'form-control', 'placeholder' =>  'Phone', 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('email', 'Email' , ['class' => 'col-form-label required']) }}
                {{ Form::email('email', Null, ['class' => 'form-control', 'placeholder' =>  'Email', 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12 ">
            <button type="submit" class="btn btn-primary ml-3l" id="submit" style="width: 100%;" >Submit</button>
        </div>
    </div>
</fieldset>
