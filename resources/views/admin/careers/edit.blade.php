@extends('adminlte::page')

@section('title', 'Papandayan | Edit Job')

@section('plugins.TempusDominusBs4', true)
@section('plugins.Summernote', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Job</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.careers.index') }}">Jobs</a></li>
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
                    <h3 class="card-title">Form Job</h3>
                </div>
                <form method="POST" action="{{ route('admin.careers.update', $career) }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="position" class="col-sm-3 col-form-label">Position <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="position" name="position" value="{{ $career->position }}" maxlength="255" placeholder="Position" required>
                                        <span class="error invalid-feedback">{{ $errors->first('position') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="location" class="col-sm-3 col-form-label">Location <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="location" name="location" value="{{ $career->location }}" maxlength="255" placeholder="Location" required>
                                        <span class="error invalid-feedback">{{ $errors->first('location') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="postingAt" class="col-sm-3 col-form-label">Posting At <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group date" id="postingAt" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="posting_at" value="{{ $career->posting_at ? $career->posting_at->format('d-m-Y') : '' }}" data-target="#postingAt" placeholder="dd-MM-yyyy" required/>
                                            <div class="input-group-append" data-target="#postingAt" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('posting_at') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="closingAt" class="col-sm-3 col-form-label">Closing At <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group date" id="closingAt" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="closing_at" value="{{ $career->closing_at ? $career->closing_at->format('d-m-Y') : '' }}" data-target="#closingAt" placeholder="dd-MM-yyyy" required/>
                                            <div class="input-group-append" data-target="#closingAt" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('closing_at') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="workType" class="col-sm-3 col-form-label">Work Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2bs4" style="width: 100%;" id="workType" name="work_type" required>
                                            <option value="{{ $career->work_type }}">{{ $career->work_type }}</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Internship">Internship</option>
                                            <option value="Part Time">Part Time</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('work_type') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="workExperience" class="col-sm-3 col-form-label">Work Experience <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2bs4" style="width: 100%;" id="workExperience" name="work_experience" required>
                                            <option value="{{ $career->work_experience }}">{{ $career->work_experience }}</option>
                                            <option value="Expert">Expert</option>
                                            <option value="Fresh Graduate">Fresh Graduate</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('work_experience') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="status" name="status" required>
                                            <option value="{{ $career->status }}">{{ $career->status }}</option>
                                            <option value="Draft">Draft</option>
                                            <option value="Pending Review">Pending Review</option>
                                            <option value="Private">Private</option>
                                            <option value="Published">Published</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qualification" class="col-sm-3 col-form-label">Qualification <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="qualification" name="qualification" maxlength="65535" placeholder="Qualification" required>{{ $career->qualification }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('qualification') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description" name="description" maxlength="65535" placeholder="Description" required>{{ $career->description }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.careers.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
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
            $('#postingAt, #closingAt').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            
            // Initialize Summernote Editor
            $('#qualification, #description').summernote();

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