@extends('adminlte::page')

@section('title', 'Papandayan | Add History')

@section('plugins.TempusDominusBs4', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add History</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.histories.index') }}">Histories</a></li>
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
                    <h3 class="card-title">Form History</h3>
                </div>
                <form method="POST" action="{{ route('admin.histories.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" maxlength="255" placeholder="Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="historyAt" class="col-sm-3 col-form-label">History At <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group date" id="historyAt" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="track_record_at" value="{{ old('track_record_at') }}" data-target="#historyAt" placeholder="dd-MM-yyyy" required/>
                                            <div class="input-group-append" data-target="#historyAt" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('track_record_at') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description" name="description" maxlength="65535" placeholder="Description" required>{{ old('description') }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.histories.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- add stylesheets --}}
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize DatePicker
            $('#historyAt').datetimepicker({
                format: 'DD-MM-YYYY'
            });
        });
    </script>
@stop