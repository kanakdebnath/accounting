@extends('layouts.app', ['title' => 'Profile', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('Home')}}</span>
                 <span class="breadcrumb-item active"><i class="icon-cog mr-2"></i> {{_lang('Profile')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center">{{_lang('Profile Update')}}</h4>
        <hr>
        <form action="{{route('admin.profile.update')}}" method="post" class="form-validate-jquery" id="content_form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Name --}}
                <div class="col-md-6 form-group">
                    <label for="first_name">{{_lang('First Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" value="{{$model->first_name}}" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>
                    <input type="hidden" name="id" value="{{$model->id}}">
                </div>

                {{-- Name --}}
                <div class="col-md-6 form-group">
                    <label for="last_name">{{_lang('Last Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" value="{{$model->last_name}}" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" required>
                </div>

                {{-- Father Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Father Name')}}
                    </label>
                    <input type="text" value="{{$model->father_name}}" name="father_name" id="father_name" class="form-control"
                        placeholder="Enter Father Name" >
                </div>

                {{-- Mother Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Mother Name')}}
                    </label>
                    <input type="text" value="{{$model->mother_name}}" name="mother_name" id="mother_name" class="form-control"
                        placeholder="Enter Mother Name" >
                </div>

                {{-- Contact Number --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Contact Number')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" value="{{$model->contact_number}}" name="contact_number" id="contact_number" class="form-control"
                        placeholder="Enter Contact Number" required maxlength="14">
                </div>

                {{-- Email --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Email')}} <span class="text-danger">*</span>
                    </label>
                    <input type="email" value="{{$model->email}}" name="email" id="email" class="form-control"
                        placeholder="admin@admin.com" required >
                </div>

                {{-- Gender --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Gender')}} <span class="text-danger">*</span>
                    </label>

                    <select data-parsley-errors-container="#parsley_error_select_gender_for_creating_new_Member"
                        data-placeholder="Please Select One" name="gender" id="gender" class="form-control select"
                        required>
                        <option value="">{{_lang('Please Select One')}}..</option>
                        <option {{$model->gender == "Male"?"selected":''}} value="Male">{{_lang('Male')}}</option>
                        <option {{$model->gender == "Female"?"selected":''}} value="Female">{{_lang('Female')}}</option>
                    </select>
                    <span id="parsley_error_select_gender_for_creating_new_Member"></span>
                </div>

                {{-- Date Of Birth --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Birth')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" value="{{$model->date_of_birth}}" autocomplete="off" name="date_of_birth" id="date_of_birth"
                        class="form-control date" required>
                </div>

                {{-- Old Photo --}}
                @if ($model->photo)
                <div class="col-md-6 form-group pt-3">
                    <label for="name">{{_lang('Old Photo')}}: </label>
                    <img src="{{asset('storage/logo')}}/{{$model->photo}}" height="80px" width="120px" alt="User Image">
                    <input type="hidden" name="old_photo" value="{{$model->photo}}">
                </div>
                @endif

                {{-- Photo --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Photo')}} </label>
                    <input type="file" autocomplete="off" name="photo" id="photo" class="form-control">
                </div>
            </div>

                <div class="text-right">
                <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update Profile')}}<i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">Processing <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                </div>
            </form>
    </div>
</div>
<!-- /basic initialization -->
@stop
@push('scripts')
<script>
$(document).ready(function () {
_formValidation();
});
</script>
<script src="{{ asset('js/admin/profile.js') }}"></script>
@endpush
