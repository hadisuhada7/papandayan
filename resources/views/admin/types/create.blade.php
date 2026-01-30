@extends('adminlte::page')

@section('title', 'Papandayan | Add Type')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Type</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.types.index') }}">Types</a></li>
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
                    <h3 class="card-title">Form Type</h3>
                </div>
                <form method="POST" action="{{ route('admin.types.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.types.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
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
@stop