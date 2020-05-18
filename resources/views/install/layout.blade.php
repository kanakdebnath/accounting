<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title .' | '. config('app.institue_name', config('app.name', 'Satt Loan')) :  config('app.institue_name', config('app.name', 'Satt Loan'))}}</title>
        <link rel="shortcut icon" href="{{  asset('favicon.png')}}">
        @include('_partials.admin.stylesheet')
        <script>
        const Base_url_admin = '{{ app_url() . 'admin/' }}';
        const Base_url = '{{ app_url() . '' }}';
        </script>
        <style>
        .pace{-webkit-pointer-events:none;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;user-select:none}.pace-inactive{display:none}.pace .pace-progress{background:#29d;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}.pace .pace-progress-inner{display:block;position:absolute;right:0;width:100px;height:100%;box-shadow:0 0 10px #29d,0 0 5px #29d;opacity:1;-webkit-transform:rotate(3deg) translate(0,-4px);-moz-transform:rotate(3deg) translate(0,-4px);-ms-transform:rotate(3deg) translate(0,-4px);-o-transform:rotate(3deg) translate(0,-4px);transform:rotate(3deg) translate(0,-4px)}.pace .pace-activity{display:block;position:fixed;z-index:2000;top:15px;right:15px;width:14px;height:14px;border:solid 2px transparent;border-top-color:#29d;border-left-color:#29d;border-radius:10px;-webkit-animation:pace-spinner .4s linear infinite;-moz-animation:pace-spinner .4s linear infinite;-ms-animation:pace-spinner .4s linear infinite;-o-animation:pace-spinner .4s linear infinite;animation:pace-spinner .4s linear infinite}@-webkit-keyframes pace-spinner{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes pace-spinner{0%{-moz-transform:rotate(0);transform:rotate(0)}100%{-moz-transform:rotate(360deg);transform:rotate(360deg)}}@-o-keyframes pace-spinner{0%{-o-transform:rotate(0);transform:rotate(0)}100%{-o-transform:rotate(360deg);transform:rotate(360deg)}}@-ms-keyframes pace-spinner{0%{-ms-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes pace-spinner{0%{transform:rotate(0);transform:rotate(0)}100%{transform:rotate(360deg);transform:rotate(360deg)}}
        </style>
    </head>
    <body>
        {{-- <div class="preloader" style="background-image: url({{ asset('asset/table_loader.gif') }});"></div> --}}
        <!-- Page content -->
        <div class="page-content ">
            <!-- Main content -->
            <div class="content-wrapper">
                <div class="page-header page-header-light border-bottom-success rounded-top-0">
                    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                {{--  <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> @lang('satt.home')</a> --}}
                                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> Insatll</span>
                            </div>
                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Content area -->
                <div class="content">
                    <!-- Basic initialization -->
                    <div class="card border-top-success rounded-top-0" id="table_card">
                        <div class="card-header header-elements-inline bg-light border-grey-300" >
                            <h5 class="card-title">Installation</h5>
                            <div class="header-elements">
                                <a class="list-icons-item" data-action="fullscreen" title="Full Screen" data-popup="tooltip" data-placement="bottom"></a>
                            </div>
                        </div>
                        <div class="card-body" id="content">
                            {!! Form::open(['route' => 'install', 'class' => 'form-validate-jquery', 'id' => 'install_form', 'method' => 'POST']) !!}
                            <fieldset class="mb-3">
                                <legend class="text-uppercase font-size-sm font-weight-bold">Terms And Condition </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group pt-2">
                                            <label class="font-weight-semibold">Left stacked styled</label>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="hidden" name="step_0" value="step_0">
                                                    <input type="checkbox" name="terms" id="terms" class="form-input-styled" data-fouc data-parsley-errors-container="#terms_error">
                                                    Checked styled
                                                </label>
                                                <span id="terms_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 ">
                                        <button type="submit" class="btn btn-primary ml-3l" id="submit" data-url="{{ route('install.server') }}" style="width: 100%;" >Submit</button>

                                    </div>
                                </div>
                            </fieldset>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- /basic initialization -->
                <!-- Footer -->
                @include('_partials.admin.footer')
                <!-- /footer -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /page content -->
        @include('_partials.admin.scripts')
        {{-- <script src="{{ asset('asset/global_assets/js/plugins/forms/wizards/steps.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('asset/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script> --}}
        <script src="{{ asset('js/install.js') }}"></script>
        <script>
        paceOptions = {
        ajax: true, // disabled
        };
        Pace.start();
        </script>
    </body>
</html>