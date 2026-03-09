@extends('adminlte::page')

@section('title', 'Papandayan | Two-Factor Authentication Settings')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Two-Factor Authentication (2FA) Settings</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Two-Factor Authentication</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Status 2FA</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="icon fas fa-check"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="icon fas fa-ban"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if($google2fa_enabled)
                        <div class="alert alert-success">
                            <h5><i class="icon fas fa-check-circle"></i> 2FA Active</h5>
                            Your account is currently protected with Two-Factor Authentication.
                        </div>

                        <form action="{{ route('account.two-factor.disable') }}" method="POST" onsubmit="return confirm('Are you sure you want to disable 2FA?')">
                            @csrf
                            <div class="form-group">
                                <label for="password">Enter Password to Disable 2FA</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times-circle"></i> Disable 2FA
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> 2FA Not Active</h5>
                            Two-Factor Authentication is not yet enabled on your account. Enable it for additional security.
                        </div>

                        <a href="{{ route('account.two-factor.enable') }}" class="btn btn-primary">
                            <i class="fas fa-shield-alt"></i> Enable 2FA
                        </a>
                    @endif
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">About Two-Factor Authentication</h3>
                </div>
                <div class="card-body">
                    <p>Two-Factor Authentication (2FA) adds an extra layer of security to your account. In addition to your password, you will also need a verification code from an authenticator app on your smartphone.</p>
                    
                    <h6><strong>To use 2FA, you need:</strong></h6>
                    <ul>
                        <li>An authenticator app such as Google Authenticator, Microsoft Authenticator or Authy</li>
                        <li>A smartphone or tablet to install the app</li>
                    </ul>

                    <h6><strong>Download Authenticator App:</strong></h6>
                    <ul>
                        <li><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Google Authenticator (Android)</a></li>
                        <li><a href="https://apps.apple.com/app/google-authenticator/id388497605" target="_blank">Google Authenticator (iOS)</a></li>
                        <li><a href="https://www.microsoft.com/store/apps/9nblggh08h54" target="_blank">Microsoft Authenticator</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
