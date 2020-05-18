@extends('layouts.app')
@section('content')
{{--  --}}
<!-- Content area -->
<div class="content d-flex justify-content-center align-items-center">
    <!-- Login form -->
    <form class="login-form" action="{{ route('login') }}" method="post" id="content_form">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i id="user_icon" class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Login to your account</h5>
                    <span class="d-block text-muted">Enter your credentials below</span>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="text" class="form-control" id="email_or_username" name="email_or_username" placeholder="Email" required autocomplete="email_or_username" autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password" placeholder="Password">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="submit">Sign in</button>
                </div>
                <div class="text-center">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <!-- /login form -->
</div>
<!-- /content area -->
@endsection
@push('scripts')
<script src="{{ asset('js/pages/auth/login.js') }}"></script>
@endpush