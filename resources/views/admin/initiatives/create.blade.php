@extends('adminlte::page')

@section('title', 'Papandayan | Add Initiative')

@section('plugins.BsCustomFileInput', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Summernote', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Initiative</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.initiatives.index') }}">Initiatives</a></li>
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
                    <h3 class="card-title">Form Initiative</h3>
                </div>
                <form method="POST" action="{{ route('admin.initiatives.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="subtitle" class="col-sm-3 col-form-label">Subtitle <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="subtitle" name="subtitle" maxlength="65535" placeholder="Subtitle" required>{{ old('subtitle') }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('subtitle') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="about" class="col-sm-3 col-form-label">About <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="about" name="about" maxlength="65535" placeholder="About" required>{{ old('about') }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('about') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author" class="col-sm-3 col-form-label">Author <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" maxlength="255" placeholder="Author" required>
                                        <span class="error invalid-feedback">{{ $errors->first('author') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="publishAt" class="col-sm-3 col-form-label">Publish At <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group date" id="publishAt" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="publish_at" value="{{ old('publish_at') }}" data-target="#publishAt" placeholder="dd-MM-yyyy" required/>
                                            <div class="input-group-append" data-target="#publishAt" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('publish_at') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="thumbnail" class="col-sm-3 col-form-label">Thumbnail <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*" required>
                                                <label class="custom-file-label" for="thumbnail" data-browse="Browse">Choose file</label>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('thumbnail') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="status" name="status" required>
                                            <option value="">-- Select Status --</option>
                                            <option value="Draft">Draft</option>
                                            <option value="Pending Review">Pending Review</option>
                                            <option value="Private">Private</option>
                                            <option value="Published">Published</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.initiatives.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
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
        /* Modify Select2 */
        .select2-container--bootstrap4 .select2-selection--single:focus,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--single {
            box-shadow: none !important;
        }

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
            // Initialize DatePicker
            $('#publishAt').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            
            // Initialize bsCustomFileInput
            bsCustomFileInput.init();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            // Initialize Summernote Editor
            $('#about').summernote();

            // Numeric Input Restriction
            $(document).on("keypress", ".number-only", function (e) {
                return ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(e.key)
            });
            
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