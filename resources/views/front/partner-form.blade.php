@extends('front.layouts.app')

@section('title', 'Form Kemitraan')

@section('plugins.BsCustomFileInput', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content')

    <!--banner sec start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>Form Kemitraan</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.partner') }}">Kemitraan</a></li>
                    <li class="breadcrumb-item active">Form Kemitraan</li>
                </ul>
            </div>
        </div>
    </section>
    <!--banner sec end-->

    <!--form partner start-->
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

                                            <form method="POST" action="{{ route('front.partner.store') }}" enctype="multipart/form-data">
                                                @csrf

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
                                                    <h4>Informasi Mitra</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="fullName" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="fullName" name="full_name" maxlength="100" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="email" name="email" maxlength="50" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="phoneNumber" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control number-only" id="phoneNumber" name="phone_number" maxlength="15" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <label for="companyName" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="companyName" name="company_name" maxlength="100" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="commentFormGroup">
                                                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" id="address" name="address" maxlength="255" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="commentFormGroup">
                                                            <label for="description" class="form-label">Deskripsi Perusahaan Mitra <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" id="description" name="description" maxlength="65535" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btnCustom2 btn-1 hover-slide-down"><span>Submit <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></button>
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
    <!--form partner end-->

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
            background-color: #f3f9ff !important;
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
        
        /* jQuery Validate error styling */
        .is-invalid {
            border-color: #dc3545 !important;
        }
        
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }
        
        .is-valid {
            border-color: #28a745 !important;
        }
        
        .select2-container--bootstrap4 .select2-selection--single.is-invalid {
            border-color: #dc3545 !important;
        }
        
        .select2-container--bootstrap4 .select2-selection--single.is-invalid .select2-selection__rendered {
            border-color: #dc3545 !important;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function () {
            // Custom email validation method
            $.validator.addMethod("emailDomain", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Gunakan format email yang valid dengan domain lengkap (contoh: nama@domain.com)");

            // Custom file size validation method
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0] && element.files[0].size <= param);
            }, "Ukuran file maksimal 1MB");

            // Initialize form validation
            const partnerForm = $('form[action="{{ route('front.partner.store') }}"]');
            
            partnerForm.validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.parent().hasClass('input-group')) {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass('select2bs4')) {
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                    if ($(element).hasClass('select2bs4')) {
                        $(element).next('.select2-container').find('.select2-selection').addClass('is-invalid');
                    }
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                    if ($(element).hasClass('select2bs4')) {
                        $(element).next('.select2-container').find('.select2-selection').removeClass('is-invalid');
                    }
                },
                ignore: [],
                rules: {
                    full_name: {
                        required: true,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email: true,
                        emailDomain: true,
                        maxlength: 50
                    },
                    phone_number: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    company_name: {
                        required: true,
                        maxlength: 100
                    },
                    address: {
                        required: true,
                        maxlength: 255
                    },
                    description: {
                        required: true,
                        maxlength: 65535
                    }
                },
                messages: {
                    full_name: {
                        required: 'Nama lengkap harus diisi',
                        maxlength: 'Nama lengkap maksimal 100 karakter'
                    },
                    email: {
                        required: 'Email harus diisi',
                        email: 'Gunakan format email yang valid',
                        maxlength: 'Email maksimal 50 karakter'
                    },
                    phone_number: {
                        required: 'Nomor telepon harus diisi',
                        digits: 'Hanya boleh diisi angka',
                        minlength: 'Nomor telepon minimal 10 digit',
                        maxlength: 'Nomor telepon maksimal 15 digit'
                    },
                    company_name: {
                        required: 'Nama perusahaan harus diisi',
                        maxlength: 'Nama perusahaan maksimal 100 karakter'
                    },
                    address: {
                        required: 'Alamat harus diisi',
                        maxlength: 'Alamat maksimal 255 karakter'
                    },
                    description: {
                        required: 'Deskripsi perusahaan harus diisi',
                        maxlength: 'Deskripsi perusahaan maksimal 65535 karakter'
                    }
                },
                submitHandler: function(form) {
                    
                    form.submit();
                }
            });

            // Numeric Input Restriction
            $(document).on("keypress", ".number-only", function (e) {
                return ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(e.key)
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