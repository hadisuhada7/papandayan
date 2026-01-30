@extends('adminlte::page')

@section('title', 'Papandayan | Add Banner')

@section('plugins.BsCustomFileInput', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Banner</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
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
                    <h3 class="card-title">Form Banner</h3>
                </div>
                <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="heading" class="col-sm-3 col-form-label">Heading <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading') }}" maxlength="255" placeholder="Heading" required>
                                        <span class="error invalid-feedback">{{ $errors->first('heading') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subheading" class="col-sm-3 col-form-label">Subheading <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="subheading" name="subheading" maxlength="65535" placeholder="Subheading" required>{{ old('subheading') }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('subheading') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="banner" class="col-sm-3 col-form-label">Banner <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="banner" name="banner" accept="image/*" required>
                                                <label class="custom-file-label" for="banner" data-browse="Browse">Choose file</label>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('banner') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="link" class="col-sm-3 col-form-label">Link <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}" maxlength="255" placeholder="Link" required>
                                        <span class="error invalid-feedback">{{ $errors->first('link') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
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
            // Initialize bsCustomFileInput
            bsCustomFileInput.init();
            
            // Add file validation for the avatar input
            $('#avatar').on('change', function(e) {
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