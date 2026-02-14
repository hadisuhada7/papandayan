@extends('adminlte::page')

@section('title', 'Papandayan | Edit Email Config')

@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Email Config</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.email-configs.index') }}">Email Configs</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Form Email Config</h3>
                </div>
                <form method="POST" action="{{ route('admin.email-configs.update', $emailConfig) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $emailConfig->name) }}" maxlength="255" placeholder="Name">
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2bs4" style="width: 100%;" id="type" name="type" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="ticket" @selected(old('type', $emailConfig->type) === 'ticket')>Ticket</option>
                                            <option value="notification" @selected(old('type', $emailConfig->type) === 'notification')>Notification</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('type') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="host" class="col-sm-3 col-form-label">Host <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="host" name="host" value="{{ old('host', $emailConfig->host) }}" maxlength="255" placeholder="Host" required>
                                        <span class="error invalid-feedback">{{ $errors->first('host') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="port" class="col-sm-3 col-form-label">Port <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="port" name="port" value="{{ old('port', $emailConfig->port) }}" min="1" placeholder="Port" required>
                                        <span class="error invalid-feedback">{{ $errors->first('port') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $emailConfig->username) }}" maxlength="255" placeholder="Username" required>
                                        <span class="error invalid-feedback">{{ $errors->first('username') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" maxlength="255" placeholder="Password">
                                        <small class="text-muted">Leave blank to keep existing password</small>
                                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="encryption" class="col-sm-3 col-form-label">Encryption</label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2bs4" style="width: 100%;" id="encryption" name="encryption">
                                            <option value="" @selected(old('encryption', $emailConfig->encryption) === '')>None</option>
                                            <option value="tls" @selected(old('encryption', $emailConfig->encryption) === 'tls')>TLS</option>
                                            <option value="ssl" @selected(old('encryption', $emailConfig->encryption) === 'ssl')>SSL</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('encryption') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fromAddress" class="col-sm-3 col-form-label">From Address <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="fromAddress" name="from_address" value="{{ old('from_address', $emailConfig->from_address) }}" maxlength="255" placeholder="From Address" required>
                                        <span class="error invalid-feedback">{{ $errors->first('from_address') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fromName" class="col-sm-3 col-form-label">From Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="fromName" name="from_name" value="{{ old('from_name', $emailConfig->from_name) }}" maxlength="255" placeholder="From Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('from_name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Active</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="isActive" name="is_active" value="1" @checked(old('is_active', $emailConfig->is_active))>
                                            <label class="custom-control-label" for="isActive">Set as active config</label>
                                            <span class="error invalid-feedback">{{ $errors->first('is_active') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.email-configs.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">
        /* Modify Select2 */
        .select2-container--bootstrap4 .select2-selection--single:focus,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--single {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection--multiple:focus,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--multiple {
            box-shadow: none !important;
        }
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@stop
