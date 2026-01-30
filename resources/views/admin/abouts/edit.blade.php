@extends('adminlte::page')

@section('title', 'Papandayan | Edit Vision & Mission')

@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Vision & Mission</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.abouts.index') }}">Vision & Mission</a></li>
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
                    <h3 class="card-title">Form Vision & Mission</h3>
                </div>
                <form method="POST" action="{{ route('admin.abouts.update', $about) }}" enctype="multipart/form-data" class="form-horizontal">
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $about->name }}" maxlength="255" placeholder="Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="icon" class="col-sm-3 col-form-label">Icon <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <img src="{{ Storage::url($about->icon) }}" alt="" style="max-width: 100px; margin-bottom: 15px;"> 
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="icon" name="icon" accept="image/*">
                                                <label class="custom-file-label" for="icon" data-browse="Browse">Choose file</label>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('icon') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="thumbnail" class="col-sm-3 col-form-label">Thumbnail <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <img src="{{ Storage::url($about->thumbnail) }}" alt="" style="max-width: 100px; margin-bottom: 15px;"> 
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*">
                                                <label class="custom-file-label" for="thumbnail" data-browse="Browse">Choose file</label>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('thumbnail') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="type" name="type" required>
                                            <option value="{{ $about->type }}">{{ $about->type }}</option>
                                            <option value="Visions">Visions</option>
                                            <option value="Missions">Missions</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('type') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description" name="description" maxlength="65535" placeholder="Description"  required>{{ $about->description }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                @php 
                                    $i = 0; 
                                @endphp
                                @forelse ($about->keypoints as $keypoint)
                                    <div class="form-group row">
                                        <label for="keypoint" class="col-sm-3 col-form-label">Keypoint {{ $i + 1 }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="keypoint" name="keypoint[]" value="{{ $keypoint->keypoint }}" maxlength="255" placeholder="Write your keypoint here">
                                            <span class="error invalid-feedback">{{ $errors->first('keypoint') }}</span>
                                        </div>
                                    </div>
                                    @php 
                                        $i++; 
                                    @endphp
                                @empty
                                    <p>No keypoints available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.abouts.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
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
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            // Initialize bsCustomFileInput
            bsCustomFileInput.init();
            
            // Add file validation for the icon and thumbnail inputs
            $('#icon, #thumbnail').on('change', function(e) {
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