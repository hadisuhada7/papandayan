@extends('adminlte::page')

@section('title', 'Papandayan | Add Safety Management')

@section('plugins.BsCustomFileInput', true)
@section('plugins.Summernote', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Safety Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.safeties.index') }}">Safety Managements</a></li>
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
                    <h3 class="card-title">Form Safety Management</h3>
                </div>
                <form method="POST" action="{{ route('admin.safeties.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="title" class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" maxlength="255" placeholder="Title" required>
                                        <span class="error invalid-feedback">{{ $errors->first('title') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="about" class="col-sm-3 col-form-label">About <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="about" name="about" maxlength="65535" placeholder="About" required>{{ old('about') }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('about') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.safeties.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">
        /* Modify Summernote Editor */
        .note-editor.card {
            margin-bottom: 0px !important;
        }
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize bsCustomFileInput
            bsCustomFileInput.init();

            // Initialize Summernote Editor
            $('#about').summernote();
            
            // Add file validation for the thumbnail input
            $('#thumbnail').on('change', function(e) {
                const file = this.files[0];
                
                if (file) {
                    // Check file size (2MB = 2097152 bytes)
                    if (file.size > 2097152) {
                        toastr.warning('File size must not exceed 2MB.');
                        $(this).val('');
                        // Reset the custom file label
                        bsCustomFileInput.destroy();
                        bsCustomFileInput.init();
                        return false;
                    }
                    
                    // Check file type
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'];
                    if (!allowedTypes.includes(file.type)) {
                        toastr.warning('File type must be PNG, JPEG, JPG, or SVG.');
                        $(this).val('');
                        // Reset the custom file label
                        bsCustomFileInput.destroy();
                        bsCustomFileInput.init();
                        return false;
                    }
                }
            });
            
            // Handle reset button to clear file input
            $('button[type="reset"]').on('click', function() {
                setTimeout(function() {
                    bsCustomFileInput.destroy();
                    bsCustomFileInput.init();
                }, 50);
            });
        });
    </script>
@stop