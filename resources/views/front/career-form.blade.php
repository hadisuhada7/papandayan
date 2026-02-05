@extends('front.layouts.app')

@section('title', 'Form Karir')

@section('plugins.BsCustomFileInput', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content')

    <!--banner sec start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>Form Karir</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Form Karir</li>
                </ul>
            </div>
        </div>
    </section>
    <!--banner sec end-->

    <!--FAQ start-->
    <section class="w-100 clearfix checkout" id="checkout">
        <div class="container">
            <div class="checkoutInner">
                <div class="row">
                    <div class="col-lg-8 order-2 order-lg-1">
                        <div class="blogSingleBlog">
                            <div class="latestNewsCardInner">
                                <div class="commentBox">
                                    <div class="commentBoxInner">
                                        <div class="commentBoxForm">

                                            <form method="POST" action="{{ route('front.career.store') }}" enctype="multipart/form-data">
                                                @csrf

                                                <!-- Hidden fields for automatic values -->
                                                <input type="hidden" name="career_id" value="{{ $career->id }}">
                                                <input type="hidden" name="status" value="New">

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

                                                <div class="commentBoxHeading">
                                                    <h4>Informasi Dasar</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="firstName" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="firstName" name="first_name" maxlength="50" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="lastName" class="form-label">Nama Belakang </label>
                                                            <input type="text" class="form-control" id="lastName" name="last_name" maxlength="50" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="email" name="email" maxlength="50" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                                                            <input type="text" class="form-control number-only" id="phoneNumber" name="phone_number" maxlength="15" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="bod" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                                            <div class="input-group date" id="bodDatepicker" data-target-input="nearest">
                                                                <input type="text" class="form-control datetimepicker-input" id="bod" name="bod" value="{{ old('bod') }}" data-target="#bodDatepicker" placeholder="dd-MM-yyyy" required/>
                                                                <div class="input-group-append" data-target="#bodDatepicker" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="commentBoxHeading">
                                                    <h4>Pendidikan</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="education" class="form-label">Pendidikan <span class="text-danger">*</span></label>
                                                            <select class="form-control select2bs4" style="width: 100%;" id="education" name="education" required>
                                                                <option value="">-- Pilih Pendidikan --</option>
                                                                <option value="SD">SD</option>
                                                                <option value="SMP">SMP</option>
                                                                <option value="SMA/SMK">SMA/SMK</option>
                                                                <option value="Sarjana (S1)">Sarjana (S1)</option>
                                                                <option value="Magister (S2)">Magister (S2)</option>
                                                                <option value="Doktor (S3)">Doktor (S3)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="major" class="form-label">Jurusan</label>
                                                            <input type="text" class="form-control" id="major" name="major" maxlength="50" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="experiencedCheckbox" class="form-label">Pengalaman Kerja</label>
                                                            <input type="hidden" id="experiencedValue" name="experienced" value="{{ old('experienced', 'No') }}">
                                                            <div class="commentFormGroup mb-0">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="experiencedCheckbox" {{ old('experienced') === 'Yes' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="experiencedCheckbox">Saya memiliki pengalaman kerja</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Experienced Applicants -->
                                                <div id="experiencedApplicants" style="display: none;">
                                                    <div class="commentBoxHeading">
                                                        <h4>Pengalaman Kerja</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="commentFormGroup">
                                                                <label for="companyName" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="companyName" name="company_name" maxlength="100" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commentFormGroup">
                                                                <label for="industry" class="form-label">Industri <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="industry" name="industry" maxlength="50" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commentFormGroup">
                                                                <label for="position" class="form-label">Posisi <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="position" name="position" maxlength="50" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commentFormGroup">
                                                                <label for="duration" class="form-label">Durasi <span class="text-danger">*</span></label>
                                                                <div class="input-group" id="durationGroup">
                                                                    <input type="text" class="form-control number-only" id="duration" name="duration" value="{{ old('duration') }}" maxlength="10" placeholder="Duration" required>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Bulan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="commentFormGroup">
                                                                <label for="currentSalary" class="form-label">Gaji Saat Ini <span class="text-danger">*</span></label>
                                                                <div class="input-group" id="currentSalaryGroup">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="text" class="form-control number-only" id="currentSalary" name="current_salary" value="{{ old('current_salary') }}" maxlength="20" placeholder="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="commentBoxHeading">
                                                    <h4>Kelengkapan</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="expectationSalary" class="form-label">Gaji Harapan <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="expectationSalaryGroup">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Rp</span>
                                                                </div>
                                                                <input type="text" class="form-control number-only" id="expectationSalary" name="expectation_salary" value="{{ old('expectation_salary') }}" maxlength="20" placeholder="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="curriculumVitae" class="form-label">Curriculum Vitae <span class="text-danger">*</span></label>
                                                            <div class="input-group" id="curriculumVitaeGroup">
                                                                <input type="file" class="form-control" id="curriculumVitae" name="curriculum_vitae" accept="application/pdf" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Browse</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btnCustom5 btn-1 hover-slide-down"><span>Kirim <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-1 order-lg-2">
                        <!-- <div class="checkoutAside">
                            <div class="productBox">
                                <div class="asideProductItem">
                                <div class="asideHeading">
                                    <h4>Product</h4>
                                </div>
                                <div class="asideProdtBx">
                                    <div class="asideImg">
                                        <div class="asideImgInner">
                                            <img src="{{ asset('images/img23.png') }}" alt="img" class="img-fluid">
                                        </div>
                                        <div class="asideContent">
                                            <h5>Bovans Browns</h5>
                                            <p>QTY : 2</p>
                                        </div>
                                    </div>
                                    <div class="asidePrice">
                                        <span class="inline-block">$40.00</span>
                                    </div>
                                </div>
                                <div class="subTotals">
                                    <div class="subTotalsHead">
                                        <p class="mb-0">Subtotals</p>
                                    </div>
                                    <div class="subTotalsNo">
                                        <span class="inline-block">$40.00</span>
                                    </div>
                                </div>
                                <hr class="horizLine">
                                <div class="subTotals">
                                    <div class="subTotalsHead">
                                        <p class="mb-0">Shipping</p>
                                    </div>
                                </div>
                                <div class="subPrice">
                                    <div class="subPriceHeading custom-radios">
                                        <div class="form-group">
                                            <input type="radio" id="flateRate" name="selectprice" checked>
                                            <label for="flateRate"><span>Flate Rate</span></label>
                                        </div>
                                    </div>
                                    <div class="asideProductPrice">
                                        <span class="inline-block">$40.00</span>
                                    </div>
                                </div>
                                <div class="subPrice">
                                    <div class="subPriceHeading custom-radios">
                                        <input type="radio" id="localPickup" name="selectprice">
                                        <label for="localPickup"><span>Local Pickup</span></label>
                                    </div>
                                    <div class="asideProductPrice">
                                        <span class="inline-block">$40.00</span>
                                    </div>
                                </div>
                                <hr class="horizLine">
                                <div class="subTotals">
                                    <div class="subTotalsHead">
                                        <p class="mb-0">Totals</p>
                                    </div>
                                    <div class="subTotalsNo">
                                        <span class="inline-block">$40.00</span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="paymentMethod">
                                <div class="paymentMethodInner">
                                <div class="asideHeading">
                                    <h4>Payment Method</h4>
                                </div>
                                <div class="paymentMethodOpt">
                                    <div class="paymentOptName custom-radios">
                                        <div class="form-group paymentformGroup">
                                            <input type="radio" id="bankTransfer" name="selectPaymentMode" checked>
                                            <label for="bankTransfer">
                                        
                                                Direct Bank Transfer
                                                <span>Make your payment directly into our bank account.</span>
                                        
                                            </label>
                                        </div>
                                        <div class="form-group paymentformGroup">
                                            <input type="radio" id="cashDelivery" name="selectPaymentMode">
                                            <label for="cashDelivery">
                                        
                                            Cash On Delivery
                                            
                                            </label>
                                        </div>
                                        <div class="form-group paymentformGroup">
                                            <input type="radio" id="chequePayments" name="selectPaymentMode">
                                            <label for="chequePayments">
                                            
                                                Cheque Payments
                                            
                                            </label>
                                        </div>
                                        <div class="form-group paymentformGroup">
                                            <input type="radio" id="paypal" name="selectPaymentMode">
                                            <label for="paypal">
                                            
                                                Paypal
                                        
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardImg">
                                    <img src="{{ asset('images/card.png') }}" alt="card" class="img-fluid">
                                </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--FAQ end-->

@endsection

@push('after-styles')
    <style type="text/css">

        /* Modify Select2 to match form inputs */
        .select2-container--bootstrap4 .select2-selection--single {
            height: auto !important;
            padding: 0 !important;
            border: none !important;
            background-color: transparent !important;
        }

        .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
            padding: 0.875rem 0.75rem !important;
            line-height: 1.5 !important;
            background-color: #F9F5F3 !important;
            border-radius: 5px !important;
            color: #6c757d !important;

        }

        .select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
            color: #6c757d !important;
        }

        .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            top: 0 !important;
            right: 0.75rem !important;
        }

        .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow b {
            border-color: #6c757d transparent transparent transparent !important;
            border-style: solid !important;
            border-width: 5px 4px 0 4px !important;
            height: 0 !important;
            right: 0.75rem !important;
            margin-left: -4px !important;
            margin-top: -2px !important;
            position: absolute !important;
            top: 50% !important;
            width: 0 !important;
        }

        .select2-container--bootstrap4 .select2-selection--single:focus,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--single,
        .select2-container--bootstrap4.select2-container--open .select2-selection--single {
            box-shadow: none !important;
            outline: none !important;
            border: none !important;
        }

        /* Match dropdown styling */
        .select2-container--bootstrap4 .select2-dropdown {
            border: 1px solid #ced4da !important;
            border-radius: 0.25rem !important;
        }

        .select2-container--bootstrap4 .select2-results__option {
            padding: 0.5rem 1rem !important;
        }

        .select2-container--bootstrap4 .select2-results__option--highlighted,
        .select2-container--bootstrap4 .select2-results__option--highlighted[aria-disabled="true"] {
            background-color: #007bff !important;
            color: white !important;
        }

        .select2-container--bootstrap4 .select2-results__option[aria-selected="true"]:not(.select2-results__option--highlighted) {
            background-color: #e9ecef !important;
            color: #6c757d !important;
        }

        /* Modify datetimepicker input group styling */
        #bodDatepicker.input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }
        
        #bodDatepicker .form-control.datetimepicker-input {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
            border-right: 0 !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        
        #bodDatepicker .input-group-append {
            margin-left: -1px !important;
            display: flex;
        }
        
        #bodDatepicker .input-group-append .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef !important;
            border: 0px !important;
            border-left: 1px solid #ced4da !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            cursor: pointer;
        }

        /* Modify curriculum vitae input group styling */
        #curriculumVitaeGroup.input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }
        
        #curriculumVitaeGroup .form-control[type="file"] {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
            border-right: 0 !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        
        #curriculumVitaeGroup .form-control[type="file"]::file-selector-button {
            display: none;
        }
        
        #curriculumVitaeGroup .form-control[type="file"] {
            color: transparent;
        }
        
        #curriculumVitaeGroup .form-control[type="file"].has-file {
            color: #212529;
        }
        
        /* Custom placeholder for file input */
        #curriculumVitaeGroup .form-control[type="file"]::before {
            content: 'Choose file';
            color: #6c757d;
            display: inline-block;
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
        }
        
        #curriculumVitaeGroup .form-control[type="file"].has-file::before {
            content: '';
        }
        
        #curriculumVitaeGroup .input-group-append {
            margin-left: -1px !important;
            display: flex;
        }
        
        #curriculumVitaeGroup .input-group-append .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef !important;
            border: 0px !important;
            border-left: 1px solid #ced4da !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            cursor: pointer;
        }

        /* Modify salary input groups styling */
        #currentSalaryGroup.input-group,
        #expectationSalaryGroup.input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }
        
        #currentSalaryGroup .input-group-prepend,
        #expectationSalaryGroup .input-group-prepend {
            margin-right: -1px !important;
            display: flex;
        }
        
        #currentSalaryGroup .input-group-prepend .input-group-text,
        #expectationSalaryGroup .input-group-prepend .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef !important;
            border: 0px !important;
            border-right: 1px solid #ced4da !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        
        #currentSalaryGroup .form-control,
        #expectationSalaryGroup .form-control {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
            border-left: 0 !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        /* Modify duration input group styling */
        #durationGroup.input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }
        
        #durationGroup .input-group-prepend {
            margin-left: -1px !important;
            display: flex;
        }
        
        #durationGroup .input-group-prepend .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef !important;
            border: 0px !important;
            border-left: 1px solid #ced4da !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
        
        #durationGroup .form-control {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
            border-right: 0 !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function () {
            // Initialize DatePicker
            $('#bodDatepicker').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            // Handle file input validation and styling
            $('#curriculumVitae').on('change', function(e) {
                const file = this.files[0];
                
                if (file) {
                    // Check file size (1MB = 1048576 bytes)
                    if (file.size > 1048576) {
                        toastr.warning('File size must not exceed 1MB.');
                        $(this).val('').removeClass('has-file');
                        return false;
                    }
                    
                    // Check file type
                    const allowedTypes = ['application/pdf'];
                    if (!allowedTypes.includes(file.type)) {
                        toastr.warning('File type must be PDF only.');
                        $(this).val('').removeClass('has-file');
                        return false;
                    }
                    
                    // Add class when file is selected
                    $(this).addClass('has-file');
                } else {
                    $(this).removeClass('has-file');
                }
            });

            // Trigger file input when Browse button is clicked
            $('#curriculumVitaeGroup .input-group-append').on('click', function() {
                $('#curriculumVitae').click();
            });

            // Numeric Input Restriction
            $(document).on("keypress", ".number-only", function (e) {
                return ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(e.key)
            });
            
            // Handle experienced applicants visibility
            const experiencedCheckbox = $('#experiencedCheckbox');
            const experiencedValueInput = $('#experiencedValue');

            function syncExperiencedValue() {
                experiencedValueInput.val(experiencedCheckbox.is(':checked') ? 'Yes' : 'No');
            }

            function toggleExperiencedApplicants() {
                const experiencedApplicants = $('#experiencedApplicants');
                const experiencedInputs = experiencedApplicants.find('input');

                if (experiencedCheckbox.is(':checked')) {
                    experiencedApplicants.slideDown();
                    experiencedInputs.attr('required', true);
                } else {
                    experiencedApplicants.slideUp();
                    experiencedInputs.attr('required', false).val('');
                }
            }

            // Initialize experienced applicants UI state on page load
            syncExperiencedValue();
            toggleExperiencedApplicants();

            // Show/hide experienced applicants when the experienced checkbox changes
            experiencedCheckbox.on('change', function() {
                syncExperiencedValue();
                toggleExperiencedApplicants();
            });

            // Handle form reset to update experienced applicants visibility
            $('button[type="reset"]').on('click', function() {
                setTimeout(function() {
                    experiencedCheckbox.prop('checked', false);
                    syncExperiencedValue();
                    toggleExperiencedApplicants();
                }, 50);
            });
        });

        // Header active class toggle on scroll
        const header = document.querySelector(".headerOne");
        const toggleClass = "headerActive";
        window.addEventListener("scroll", () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 150) {
                header.classList.add(toggleClass);
            } else {
                header.classList.remove(toggleClass);
            }
        });
   </script>
@endpush