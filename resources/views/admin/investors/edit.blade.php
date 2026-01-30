@extends('adminlte::page')

@section('title', 'Papandayan | Edit Investor Presentation')

@section('plugins.BsCustomFileInput', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Investor Presentation</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.investors.index') }}">Investor Presentations</a></li>
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
                    <h3 class="card-title">Form Investor Presentation</h3>
                </div>
                <form method="POST" action="{{ route('admin.investors.update', $investor) }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="title" class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $investor->title }}" maxlength="255" placeholder="Title" required>
                                        <span class="error invalid-feedback">{{ $errors->first('title') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="status" name="status" required>
                                            <option value="{{ $investor->status }}">{{ $investor->status }}</option>
                                            <option value="Draft">Draft</option>
                                            <option value="Pending Review">Pending Review</option>
                                            <option value="Private">Private</option>
                                            <option value="Published">Published</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="publishAt" class="col-sm-3 col-form-label">Publish At <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group date" id="publishAt" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="publish_at" value="{{ $investor->publish_at ? $investor->publish_at->format('d-m-Y') : '' }}" data-target="#publishAt" placeholder="dd-MM-yyyy" required/>
                                            <div class="input-group-append" data-target="#publishAt" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('publish_at') }}</span>
                                    </div>
                                </div>

                                @php 
                                    $i = 0; 
                                @endphp
                                @forelse ($investor->investorReports as $report)
                                    <div class="form-group row">
                                        <label for="name_{{ $i }}" class="col-sm-3 col-form-label">Name of Report {{ $i + 1 }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name_{{ $i }}" name="name[]" value="{{ $report->name }}" maxlength="255" placeholder="Name of Report {{ $i + 1 }}">
                                            <span class="error invalid-feedback">{{ $errors->first('name.' . $i) }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="report_{{ $i }}" class="col-sm-3 col-form-label">Report {{ $i + 1 }}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input report-input" id="report_{{ $i }}" name="report[]" accept="application/pdf">
                                                    <label class="custom-file-label" for="report_{{ $i }}" data-browse="Browse">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if($report->report)
                                            <a href="{{ Storage::url($report->report) }}" target="_blank" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                        @endif
                                        <span class="error invalid-feedback">{{ $errors->first('report.' . $i) }}</span>
                                    </div>
                                    @php 
                                        $i++; 
                                    @endphp
                                @empty
                                    <p>No reports available.</p>
                                @endforelse

                                @for (; $i < 6; $i++)
                                    <div class="form-group row">
                                        <label for="name_{{ $i }}" class="col-sm-3 col-form-label">Name of Report {{ $i + 1 }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name_{{ $i }}" name="name[]" value="" maxlength="255" placeholder="Name of Report {{ $i + 1 }}">
                                            <span class="error invalid-feedback">{{ $errors->first('name.' . $i) }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="report_{{ $i }}" class="col-sm-3 col-form-label">Report {{ $i + 1 }}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input report-input" id="report_{{ $i }}" name="report[]" accept="application/pdf">
                                                    <label class="custom-file-label" for="report_{{ $i }}" data-browse="Browse">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('report.' . $i) }}</span>
                                    </div>
                                @endfor

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.investors.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
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
        
        /* Custom CSS add here */
        
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

            // Add file validation for the report inputs
            $('.report-input').on('change', function(e) {
                const file = this.files[0];
                
                if (file) {
                    // Check file size (5MB = 5242880 bytes)
                    if (file.size > 5242880) {
                        toastr.warning('File size must not exceed 5MB.');
                        $(this).val('');
                        // Reset the custom file label
                        bsCustomFileInput.destroy();
                        bsCustomFileInput.init();
                        return false;
                    }
                    
                    // Check file type
                    const allowedTypes = ['application/pdf'];
                    if (!allowedTypes.includes(file.type)) {
                        toastr.warning('File type must be PDF only.');
                        $(this).val('');
                        // Reset the custom file label
                        bsCustomFileInput.destroy();
                        bsCustomFileInput.init();
                        return false;
                    }
                }
            });
        });
    </script>
@stop