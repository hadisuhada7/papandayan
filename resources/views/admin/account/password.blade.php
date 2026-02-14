@extends('adminlte::page')

@section('title', 'Papandayan | Change Password')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Change Password</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Form Change Password</h3>
                </div>
                <form method="POST" action="{{ route('account.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" name="current_password" id="currentPassword" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" name="password" id="newPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password" required>
                            <small class="form-text text-muted">Minimum 8 characters with letters and numbers</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="passwordConfirmation" class="form-control" placeholder="Re-type new password" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-outline card-secondary h-100">
                <div class="card-header">
                    <h3 class="card-title">Password Tips</h3>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Make sure your new password is different from your previous one.</li>
                        <li>Use a combination of uppercase and lowercase letters and numbers.</li>
                        <li>Don't share your password with anyone.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('partials.toastr')
@stop
