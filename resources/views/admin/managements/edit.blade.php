@extends('adminlte::page')

@section('title', 'Papandayan | Edit Management')

@section('plugins.BsCustomFileInput', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.managements.index') }}">Managements</a></li>
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
                    <h3 class="card-title">Form Management</h3>
                </div>
                <form method="POST" action="{{ route('admin.managements.update', $management) }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $management->name }}" maxlength="255" placeholder="Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="occupation" class="col-sm-3 col-form-label">Occupation <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="occupation" name="occupation" value="{{ $management->occupation }}" maxlength="255" placeholder="Occupation" required>
                                        <span class="error invalid-feedback">{{ $errors->first('occupation') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="avatar" class="col-sm-3 col-form-label">Avatar <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <img src="{{ Storage::url($management->avatar) }}" alt="" style="max-width: 100px; margin-bottom: 15px;"> 
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                                                <label class="custom-file-label" for="avatar" data-browse="Browse">Choose file</label>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('avatar') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="facebook" class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $management->facebook }}" maxlength="255" placeholder="Facebook">
                                        <span class="error invalid-feedback">{{ $errors->first('facebook') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $management->instagram }}" maxlength="255" placeholder="Instagram">
                                        <span class="error invalid-feedback">{{ $errors->first('instagram') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="twitter" class="col-sm-3 col-form-label">Twitter</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $management->twitter }}" maxlength="255" placeholder="Twitter">
                                        <span class="error invalid-feedback">{{ $errors->first('twitter') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="linkedin" class="col-sm-3 col-form-label">LinkedIn</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $management->linkedin }}" maxlength="255" placeholder="LinkedIn">
                                        <span class="error invalid-feedback">{{ $errors->first('linkedin') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.managements.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
            
            // Handle reset button
            $('button[type="reset"]').on('click', function() {
                setTimeout(function() {
                    bsCustomFileInput.destroy();
                    bsCustomFileInput.init();
                }, 50);
            });
        });
    </script>
@stop