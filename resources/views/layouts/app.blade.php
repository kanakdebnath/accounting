<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title .' | '. config('app.name', 'Satt ') :  config('app.institue_name', config('app.name', 'Satt'))}}</title>
        <link rel="shortcut icon" href="{{asset(get_option('favicon')?'storage/logo/'.get_option('favicon'):'favicon.png')}}">
        
        @include('_partials.admin.stylesheet')
        <script>
            const Base_url_admin = '{{ app_url() . 'admin/' }}';
            const Base_url = '{{ app_url() . '' }}';
        </script>
<style>
    .pace{-webkit-pointer-events:none;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;user-select:none}.pace-inactive{display:none}.pace .pace-progress{background:#29d;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}.pace .pace-progress-inner{display:block;position:absolute;right:0;width:100px;height:100%;box-shadow:0 0 10px #29d,0 0 5px #29d;opacity:1;-webkit-transform:rotate(3deg) translate(0,-4px);-moz-transform:rotate(3deg) translate(0,-4px);-ms-transform:rotate(3deg) translate(0,-4px);-o-transform:rotate(3deg) translate(0,-4px);transform:rotate(3deg) translate(0,-4px)}.pace .pace-activity{display:block;position:fixed;z-index:2000;top:15px;right:15px;width:14px;height:14px;border:solid 2px transparent;border-top-color:#29d;border-left-color:#29d;border-radius:10px;-webkit-animation:pace-spinner .4s linear infinite;-moz-animation:pace-spinner .4s linear infinite;-ms-animation:pace-spinner .4s linear infinite;-o-animation:pace-spinner .4s linear infinite;animation:pace-spinner .4s linear infinite}@-webkit-keyframes pace-spinner{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes pace-spinner{0%{-moz-transform:rotate(0);transform:rotate(0)}100%{-moz-transform:rotate(360deg);transform:rotate(360deg)}}@-o-keyframes pace-spinner{0%{-o-transform:rotate(0);transform:rotate(0)}100%{-o-transform:rotate(360deg);transform:rotate(360deg)}}@-ms-keyframes pace-spinner{0%{-ms-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes pace-spinner{0%{transform:rotate(0);transform:rotate(0)}100%{transform:rotate(360deg);transform:rotate(360deg)}}
</style>
    </head>
    <body class="@auth() navbar-top @endauth">
        {{-- <div class="preloader" style="background-image: url({{ asset('asset/table_loader.gif') }});"></div> --}}
        @auth()
        <!-- Main navbar -->
        @include('_partials.admin.main_navbar')
        <!-- /main navbar -->
        @endauth
        <!-- Page content -->
        <div class="page-content ">
            @auth()
            <!-- Main sidebar -->
            <div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md noprint">
                <!-- Sidebar mobile toggler -->
                @include('_partials.admin.sidebar_mobile_content')
                <!-- /sidebar mobile toggler -->
                <!-- Sidebar content -->
                <div class="sidebar-content noprint">
                    <!-- User menu -->
                    @include('_partials.admin.user_menu')
                    <!-- /user menu -->
                    <!-- Main navigation -->
                    @include('_partials.admin.main_navigation')
                    <!-- /main navigation -->
                </div>
                <!-- /sidebar content -->
            </div>
            <!-- /main sidebar -->
            @endauth
            <!-- Main content -->
            <div class="content-wrapper">
                @auth()
                <!-- Page header -->
                @section('page.header')
                @show
                <!-- /page header -->
                @endauth
                <!-- Content area -->
                <div class="content">
                    @section('content')
                    @show
                </div>
                <!-- /content area -->
                @auth()
                <!-- Footer -->
                @include('_partials.admin.footer')
                <!-- /footer -->
                @endauth
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
        @if(isset($modal))
        <!-- Remote source -->
        <div id="modal_remote" class="modal fade border-top-success rounded-top-0" tabindex="-1"  data-backdrop="static">
            <div class="modal-dialog modal-{{ $modal }}">
                <div class="modal-content">
                    <div class="modal-header bg-light border-grey-300">
                        <h5 class="modal-title">{{$title}}</h5>
                        <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="modal-loader" style="display: none; text-align: center;"> <img src="{{ asset('asset/preloader.gif') }}"> </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <!-- /remote source -->
        @endif
        @include('_partials.admin.scripts')
        <script>
            paceOptions = {
              ajax: true, // disabled
            };
            Pace.start();
        </script>
    </body>
</html>
