@extends('adminlte::page')

@section('title', 'Papandayan | Add Applicant')

@section('plugins.BsCustomFileInput', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Applicant</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.applicants.index') }}">Applicants</a></li>
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
                    <h3 class="card-title">Form Applicant</h3>
                </div>
                <form method="POST" action="{{ route('admin.applicants.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="career">Career <span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="career" name="career_id" required>
                                        <option value="">-- Select Career --</option>
                                        @foreach ($careers as $career)
                                            <option value="{{ $career->id }}">{{ $career->position }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('career_id') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="firstName">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name') }}" maxlength="255" placeholder="First Name" required>
                                    <span class="error invalid-feedback">{{ $errors->first('first_name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name') }}" maxlength="255" placeholder="Last Name">
                                    <span class="error invalid-feedback">{{ $errors->first('last_name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" maxlength="255" placeholder="Email" required>
                                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control number-only" id="phoneNumber" name="phone_number" value="{{ old('phone_number') }}" maxlength="15" placeholder="Phone Number" required>
                                    <span class="error invalid-feedback">{{ $errors->first('phone_number') }}</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="bod">Birth of Date <span class="text-danger">*</span></label>
                                    <div class="input-group date" id="bod" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="bod" value="{{ old('bod') }}" data-target="#bod" placeholder="dd-MM-yyyy" required/>
                                        <div class="input-group-append" data-target="#bod" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <span class="error invalid-feedback">{{ $errors->first('bod') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="education">Education <span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="education" name="education" required>
                                        <option value="">-- Select Education --</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="Sarjana (S1)">Sarjana (S1)</option>
                                        <option value="Magister (S2)">Magister (S2)</option>
                                        <option value="Doktor (S3)">Doktor (S3)</option>
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('education') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="major">Major</label>
                                    <input type="text" class="form-control" id="major" name="major" value="{{ old('major') }}" maxlength="255" placeholder="Major">
                                    <span class="error invalid-feedback">{{ $errors->first('major') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="currentSalary">Current Salary <span class="text-danger">*</span></label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control number-only" id="currentSalary" name="current_salary" value="{{ old('current_salary') }}" maxlength="20" placeholder="Current Salary" required>
                                    </div>
                                    <span class="error invalid-feedback">{{ $errors->first('current_salary') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="expectationSalary">Expectation Salary <span class="text-danger">*</span></label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control number-only" id="expectationSalary" name="expectation_salary" value="{{ old('expectation_salary') }}" maxlength="20" placeholder="Expectation Salary" required>
                                    </div>
                                    <span class="error invalid-feedback">{{ $errors->first('expectation_salary') }}</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="status" name="status" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="New">New</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="curriculumVitae">Curriculum Vitae <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="curriculumVitae" name="curriculum_vitae" accept="application/pdf" required>
                                            <label class="custom-file-label" for="curriculumVitae" data-browse="Browse">Choose file</label>
                                        </div>
                                    </div>
                                    <span class="error invalid-feedback">{{ $errors->first('curriculum_vitae') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="experienced">Experienced <span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="experienced" name="experienced" required>
                                        <option value="">-- Select Experienced --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('experienced') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Experienced Applicants -->
                        <div id="experiencedApplicants" style="display: none;">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-primary">Work Experience Details</h5>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="companyName">Company Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="companyName" name="company_name" value="{{ old('company_name') }}" maxlength="255" placeholder="Company Name">
                                        <span class="error invalid-feedback">{{ $errors->first('company_name') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="industry">Industry <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="industry" name="industry" value="{{ old('industry') }}" maxlength="255" placeholder="Industry">
                                        <span class="error invalid-feedback">{{ $errors->first('industry') }}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="position">Position <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" maxlength="255" placeholder="Position">
                                        <span class="error invalid-feedback">{{ $errors->first('position') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="duration">Duration <span class="text-danger">*</span></label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control number-only" id="duration" name="duration" value="{{ old('duration') }}" maxlength="3" placeholder="Duration">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Month</span>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('duration') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.applicants.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
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
            $('#bod').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            // Initialize bsCustomFileInput
            bsCustomFileInput.init();

            // Numeric Input Restriction
            $(document).on("keypress", ".number-only", function (e) {
                return ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(e.key)
            });
            
            // Handle experienced applicants visibility
            function toggleExperiencedApplicants() {
                const experiencedValue = $('#experienced').val();
                const experiencedApplicants = $('#experiencedApplicants');
                const experiencedInputs = experiencedApplicants.find('input');
                
                if (experiencedValue === 'Yes') {
                    experiencedApplicants.slideDown();
                    // Make experienced applicants required
                    experiencedInputs.attr('required', true);
                } else {
                    experiencedApplicants.slideUp();
                    // Remove required attribute and clear values
                    experiencedInputs.attr('required', false).val('');
                }
            }
            
            // Initialize experienced applicants visibility on page load
            toggleExperiencedApplicants();
            
            // Show/hide experienced applicants when the experienced dropdown changes
            $('#experienced').on('change', toggleExperiencedApplicants);
            
            // Handle form reset to update experienced applicants visibility
            $('button[type="reset"]').on('click', function() {
                setTimeout(function() {
                    toggleExperiencedApplicants();
                    bsCustomFileInput.destroy();
                    bsCustomFileInput.init();
                }, 50);
            });
            
            // Add file validation for the curriculum vitae input
            $('#curriculumVitae').on('change', function(e) {
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