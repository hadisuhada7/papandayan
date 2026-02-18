@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('auth_header', '2FA Verification')

@section('auth_body')
    <form action="{{ route('login.2fa.verify') }}" method="post">
        @csrf

        {{-- One Time Password field --}}
        <div class="input-group mb-3">
            <input type="text" name="one_time_password" class="form-control @error('one_time_password') is-invalid @enderror"
                   value="{{ old('one_time_password') }}" placeholder="OTP Code" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-shield-alt"></span>
                </div>
            </div>
            @error('one_time_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Enter the 6-digit OTP code from your Google Authenticator app.
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <a href="{{ route('login') }}" class="text-center">
                    Back to Login
                </a>
            </div>
            <div class="col-5">
                <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    Verify
                </button>
            </div>
        </div>

    </form>
@stop
