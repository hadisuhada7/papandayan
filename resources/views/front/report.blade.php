@extends('front.layouts.app')

@section('title', 'Laporan Tahunan')

@section('content')

   <!--banner start-->
    @forelse ($banners as $banner)
        <section class="w-100 clearfix poultryPerformanceBanner" id="poultryPerformanceBanner"
            style="background-image: url('{{ Storage::url($banner->banner) }}');">
        </section>
    @empty
        
    @endforelse
    <!--banner end-->

   <div class="breadcrumb">
        <div class="container">
    <ul>
        <li><a href="{{ route('front.index') }}">Beranda</a></li>
         <li><a>Laporan Tahunan</a></li>
      </ul>
      </div>
   </div>

   <!--blog section start-->
   <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
      <div class="container">
         <div class="blogArticlesInner">
            <div class="latestNewsCard">
               <div class="row blogWithSidebarRow">

                  @forelse ($reports as $report)
                  <div class="col-md-12 col-lg-3 blogWithSidebarCol">
                     <div class="latestNewsCardInner mb-4">
                        <div class="latestNewsCardImg">
                           <a href="blog-single.html"><img src="{{ Storage::url($report->thumbnail) }}" alt="img"
                                 class="w-100 img-fluid"></a>
                           <!-- <div class="latestNewsDate">
                              <a href="javascript:void(0);">
                                 <h5>25</h5>
                                 <span>Mar</span>
                              </a>
                           </div> -->
                        </div>
                        <div class="latestNewsCardInnerContent">
                           <!-- <div class="latestNewsList">
                              <div class="latestNewsUser">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/icon/user.png') }}" alt="icon" class="img-fluid"><span>by admin</span>
                                 </a>
                              </div>
                              <div class="latestNewsMessage">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/icon/message.png') }}" alt="icon" class="img-fluid"><span>2
                                       comments</span>
                                 </a>
                              </div>
                           </div> -->
                           <div class="latestNewsTxt" style="margin-top: 20px;">
                              <h4><a href="blog-single.html">{{ $report->name }}</a></h4>
                              <!-- <p>{{ $report->subtitle }}</p> -->
                           </div>
                           <div class="latestNewBtn">
                              <a class="btnCustom5 btn-1 item-download" href="javascript:void(0);" data-id="{{ $report->id }}">
                                 <span>Download <i class="fa fa-download"></i></span>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @empty
                  
                  @endforelse
               </div>
            </div>
            
            <!-- Download Modal -->
            <div class="modal fade" id="modal-download" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Download Laporan Tahunan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="download-form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="modal-name" class="col-sm-3 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="modal-name" name="name" maxlength="255" placeholder="Nama Lengkap" required>
                                                <span class="error invalid-feedback" id="name-error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="modal-email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="modal-email" name="email" maxlength="255" placeholder="Email" required>
                                                <span class="error invalid-feedback" id="email-error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="report" class="col-sm-3 col-form-label">Laporan</label>
                                            <div class="col-sm-9">
                                                <span id="report-name" class="form-control-plaintext font-weight-bold"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="btn-modal-download">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
            
            {{ $reports->links('front.partials.pagination') }}
         </div>
      </div>
   </section>
   <!--blog section end-->
@endsection

@push('after-styles')
    <style>
        /* Highlight selected report card */
        .latestNewsCardInner:target {
            outline: 2px solid var(--accent-color, #3c5fac);
            border-radius: 18px;
            box-shadow: 0 0 0 6px rgba(60, 95, 172, 0.08);
        }

        /* Modal close button styling */
        #modal-download .modal-header .close {
            padding: 0.5rem 1rem;
            margin: -0.5rem -1rem -0.5rem auto;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
            background: transparent;
            border: 0;
            cursor: pointer;
        }

        #modal-download .modal-header .close:hover,
        #modal-download .modal-header .close:focus {
            color: #000;
            text-decoration: none;
            opacity: .75;
            outline: none;
        }

        #modal-download .modal-header .close span {
            display: block;
            font-size: 2rem;
            line-height: 1;
        }

        #modal-download .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
@endpush

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function () {
            const $modal = $('#modal-download');
            const $form = $('#download-form');
            const $nameInput = $('#modal-name');
            const $emailInput = $('#modal-email');
            const $submitButton = $('#btn-modal-download');
            const $reportName = $('#report-name');

            let selectedReport = { id: null, name: '' };

            const getCsrfToken = function () {
                return $('meta[name="csrf-token"]').attr('content') || $form.find('input[name="_token"]').val();
            };

            const resetFormState = function () {
                $form.trigger('reset');
                $form.find('.is-invalid').removeClass('is-invalid');
                $form.find('.invalid-feedback').text('').hide();
                $submitButton.prop('disabled', false).text('Kirim');
            };

            $('.item-download').on('click', function (e) {
                e.preventDefault();

                selectedReport.id = $(this).data('id');
                selectedReport.name = $(this).closest('.latestNewsCardInner').find('.latestNewsTxt h4 a').text().trim();

                $reportName.text(selectedReport.name);
                resetFormState();
                $modal.modal('show');
            });

            $modal.on('hidden.bs.modal', function () {
                resetFormState();
                selectedReport = { id: null, name: '' };
            });

            // Custom email validation method
            $.validator.addMethod("emailDomain", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
            }, "Gunakan format email yang valid dengan domain lengkap (contoh: nama@domain.com)");

            $form.validate({
                errorClass: 'is-invalid',
                ignore: [],
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        email: true,
                        emailDomain: true,
                        maxlength: 255
                    }
                },
                messages: {
                    name: {
                        required: 'Nama harus diisi',
                        maxlength: 'Nama maksimal 255 karakter'
                    },
                    email: {
                        required: 'Email harus diisi',
                        email: 'Gunakan format email yang valid',
                        maxlength: 'Email maksimal 255 karakter'
                    }
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                    $(element).siblings('.invalid-feedback').text('').hide();
                },
                errorPlacement: function (error, element) {
                    const $feedback = element.siblings('.invalid-feedback');
                    if ($feedback.length) {
                        $feedback.text(error.text()).show();
                    }
                },
                submitHandler: function () {
                    if (!selectedReport.id) {
                        Toast.error('Error: Tidak ada laporan yang dipilih');
                        return false;
                    }

                    const payload = {
                        _token: getCsrfToken(),
                        name: $nameInput.val().trim(),
                        email: $emailInput.val().trim()
                    };

                    const submitUrl = "{{ route('front.report.download.with.log', ':id') }}".replace(':id', selectedReport.id);

                    $submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

                    $.ajax({
                        url: submitUrl,
                        type: 'POST',
                        data: payload,
                        dataType: 'json'
                    }).done(function () {
                        $modal.modal('hide');
                        Toast.success('Download laporan dimulai...');

                        const downloadUrl = "{{ route('front.report.download', ':id') }}".replace(':id', selectedReport.id);
                        const iframe = document.createElement('iframe');
                        iframe.style.display = 'none';
                        iframe.src = downloadUrl;
                        document.body.appendChild(iframe);

                        setTimeout(function () {
                            if (iframe.parentNode) {
                                document.body.removeChild(iframe);
                            }
                        }, 5000);
                    }).fail(function (xhr, status, error) {
                        let errorMsg = 'Terjadi kesalahan!';

                        if (xhr.status === 422) {
                            try {
                                const response = xhr.responseJSON || JSON.parse(xhr.responseText);
                                if (response && response.errors) {
                                    const errors = Object.values(response.errors).flat();
                                    errors.forEach(function(err) {
                                        Toast.error(err);
                                    });
                                    return;
                                }
                            } catch (err) {
                                errorMsg = 'Input tidak valid.';
                            }
                        } else if (xhr.status === 419) {
                            errorMsg = 'CSRF token mismatch. Silakan refresh halaman.';
                        } else if (xhr.status === 404) {
                            errorMsg = 'Laporan tidak ditemukan.';
                        } else if (xhr.status === 500) {
                            errorMsg = 'Server error. Silakan coba lagi.';
                        } else if (xhr.status) {
                            errorMsg = 'Error ' + xhr.status + ': ' + error;
                        }

                        Toast.error(errorMsg);
                    }).always(function () {
                        $submitButton.prop('disabled', false).text('Kirim');
                    });

                    return false;
                }
            });

            $submitButton.on('click', function (e) {
                e.preventDefault();
                $form.submit();
            });

            // Handle cancel button click
            $('.btn-secondary[data-dismiss="modal"]').on('click', function() {
                $modal.modal('hide');
            });

            // Handle close (X) button click
            $modal.find('.close[data-dismiss="modal"]').on('click', function() {
                $modal.modal('hide');
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
