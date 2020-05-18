{{-- {{ dd(auth()->user()->getProfile()) }} --}}
@extends('layouts.app', ['title' => 'Dahsboard', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> HOME</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->

<!-- /basic initialization -->
@stop
@push('admin.scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/main.js') }}"></script>
<!-- /theme JS files -->
@endpush