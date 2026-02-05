@extends('front.layouts.app')

@section('title', 'Hubungi Kami')

@section('plugins.BsCustomFileInput', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
@section('plugins.Toastr', true)
   
@section('content')

    <!--banner start-->
    @forelse ($banners as $banner)
        <section class="w-100 clearfix poultryPerformanceBanner" id="poultryPerformanceBanner" style="background-image: url('{{ Storage::url($banner->banner) }}');">
        </section>
    @empty
    @endforelse
    <!--banner end-->

    <!--breadcrumb start-->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ route('front.index') }}">Beranda</a></li>
                <li><a>Hubungi Kami</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->

    <!--contact start-->
    <section class="w-100 clearfix contactSec" id="contactSec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contactInfo">
                        <div class="commonHeading">
                            <h4>Informasi Kontak</h4>
                            <p style="text-align: justify;">Kami berdedikasi untuk memberikan solusi terbaik bagi Anda. Jangan ragu untuk menghubungi kami untuk konsultasi lebih lanjut.</p>
                        </div>
                        <div class="infoGroup">
                            
                            @forelse ($contacts as $contact)
                                <a href="javascript:void(0);">
                                    <div class="infoGroupItem">
                                        <div class="infoIcon">
                                            <span><img src="{{ Storage::url($contact->icon) }}" alt="location" class="img-fluid"></span>
                                        </div>
                                        <div class="infoTxt">
                                            <h4>{{ $contact->name }}</h4>
                                            <p class="mb-0">{{ $contact->description }}</p>
                                            <p class="mb-0">{{ $contact->other_description }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contactForm">
                        <h4>Hubungi Kami</h4>
                        <form method="POST" action="{{ route('question.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="formControlGroup">
                                        <input type="text" class="form-control" id="name" name="name" maxlength="255" placeholder="Nama Lengkap" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="formControlGroup">
                                        <input type="email" class="form-control" id="email" name="email" maxlength="255" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="formControlGroup">
                                        <input type="text" class="form-control number-only" id="phoneNumber" name="phone_number" maxlength="15" placeholder="Nomor Telepon" required>
                                    </div>
                                    <div class="formControlGroup">
                                        <select class="form-control select2bs4" style="width: 100%;" id="questionType" name="question_type_id" required>
                                            <option value="">-- Pilih Topik --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="formControlGroup">
                                        <textarea class="form-control" id="message" name="message" maxlength="65535" placeholder="Pesan" required></textarea>
                                    </div>
                                    <div class="formSubmitBtn">
                                        <button type="submit" class="btnCustom5 btn-1 hover-slide-down">
                                            <span>Kirim Pesan <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact end-->

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
            background-color: rgba(255, 255, 255, 0.1) !important;
            border-radius: 5px !important;
            color: #ffffff !important;

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
            border-color: #fff transparent transparent transparent !important;
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

        /* Modify match Dropdown Styling */
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
    </style>
@endpush

@push('after-scripts')
   <script>
        $(document).ready(function ($) {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
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