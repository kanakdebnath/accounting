<!-- Core JS files -->
<script src="{{ asset('asset/global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/loaders/pace.min.js') }}"></script>
<script src="{{ asset('js/layout_fixed_sidebar_custom.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/ui/perfect_scrollbar.min.js') }}"></script>
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/notifications/sweetalert.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/notifications/noty.min.js') }}"></script>
<script src="{{asset('asset/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('asset/global_assets/js/plugins/pickers/anytime.min.js')}}"></script>
<script src="{{asset('asset/global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('asset/global_assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('asset/global_assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('asset/global_assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>
<script src="{{ asset('asset/assets/js/app.js') }}"></script>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- /core JS files -->
@stack('scripts')