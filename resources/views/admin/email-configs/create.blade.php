@extends('adminlte::page')

@section('title', 'Papandayan | Add Email Config')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Email Config</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.email-configs.index') }}">Email Configs</a></li>
                <li class="breadcrumb-item active">Add</li>
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
                <form method="POST" action="{{ route('admin.email-configs.store') }}" class="form-horizontal">
                    @csrf
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="host" class="col-sm-3 col-form-label">Host <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="host" name="host" value="{{ old('host') }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="port" class="col-sm-3 col-form-label">Port <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="port" name="port" value="{{ old('port', 587) }}" min="1" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="encryption" class="col-sm-3 col-form-label">Encryption</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="encryption" name="encryption">
                                            <option value="" @selected(old('encryption') === '')>None</option>
                                            <option value="tls" @selected(old('encryption') === 'tls')>TLS</option>
                                            <option value="ssl" @selected(old('encryption') === 'ssl')>SSL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="from_address" class="col-sm-3 col-form-label">From Address <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="from_address" name="from_address" value="{{ old('from_address') }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="from_name" class="col-sm-3 col-form-label">From Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="from_name" name="from_name" value="{{ old('from_name') }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Active</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" @checked(old('is_active'))>
                                            <label class="custom-control-label" for="is_active">Set as active config</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.email-configs.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('partials.toastr')
@stop