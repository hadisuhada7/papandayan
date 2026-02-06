@extends('front.layouts.app')

@section('title', 'Presentasi Investor')

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
         <li><a>Presentasi Investor</a></li>
      </ul>
      </div>
   </div>

   @include('front.partials.filter-report', [
      'yearOptions' => $yearOptions,
      'selectedYear' => $selectedYear,
      'selectedSort' => $selectedSort,
   ])
   
   <!--blog section start-->
   <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
      <div class="container">
         <div class="blogArticlesInner">
            <div class="latestNewsCard">
               <div class="row blogWithSidebarRow">

                  @forelse ($investors as $investor)
                  <div class="col-md-12 col-lg-12 blogWithSidebarCol">
                     <div class="latestNewsCardInner mb-4 file-list">
                        <div class="list">
                           <div class="list-date"> 
                              <h6>{{ $investor->publish_at->format('d F Y') }}</h6> 
                           </div>
                           <div class="list-field">
                              <h5>{{ $investor->title }}</h5>
                              <div class="download-file"> 
                                 @forelse ($investor->investorReports as $report)
                                  <div class="file-list">
                                       <h6>{{ $report->name }}</h6>
                                       <a href="javascript:void(0);" class="link link-download item-download" data-id="{{ $report->id }}" data-name="{{ $report->name }}">Unduh PDF</a>
                                 </div>
                                 @empty

                                 @endforelse
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @empty

                  @endforelse
               </div>
            </div>
            {{ $investors->links('front.partials.pagination') }}
         </div>
      </div>
   </section>
   <!--blog section end-->

   <!-- Download Modal -->
   <div class="modal fade" id="modal-download" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-md" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Download Presentasi Investor</h4>
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
                                   <label for="document" class="col-sm-3 col-form-label">Presentasi</label>
                                   <div class="col-sm-9">
                                       <span id="document-name" class="form-control-plaintext font-weight-bold"></span>
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
@endsection

@push('after-styles')
   <style>
      .file-list .list {
         background: #fff;
         border: 1px solid #aeaeae;
         border-radius: 8px;
         display: flex;
         margin-bottom: 30px;
         padding: 26px 36px;
      }
      .file-list .list .list-date {
         flex: 0 0 150px;
         max-width: 150px;
      }
      .file-list .list .list-field {
         flex: 0 0 calc(100% - 150px);
         max-width: calc(100% - 150px);
         padding-left: 40px;
      }
      .file-list .list .list-field .download-file {
         margin-top: 30px;
      }
      .file-list .list .list-field .download-file .file-list:last-child {
         margin: 0;
      }
      .file-list .list .list-field .download-file .file-list {
         align-items: center;
         display: flex;
         justify-content: space-between;
         margin-bottom: 12px;
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
         const $documentName = $('#document-name');

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
            selectedReport.name = $(this).data('name');

            $documentName.text(selectedReport.name);
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
                  Toast.error('Error: Tidak ada presentasi yang dipilih');
                  return false;
               }

               const payload = {
                  _token: getCsrfToken(),
                  name: $nameInput.val().trim(),
                  email: $emailInput.val().trim()
               };

               const submitUrl = "{{ route('front.investor.download.with.log', ':id') }}".replace(':id', selectedReport.id);

               $submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

               $.ajax({
                  url: submitUrl,
                  type: 'POST',
                  data: payload,
                  dataType: 'json'
               }).done(function () {
                  $modal.modal('hide');
                  Toast.success('Download presentasi investor dimulai...');

                  const downloadUrl = "{{ route('front.investor.download', ':id') }}".replace(':id', selectedReport.id);
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
                     errorMsg = 'Presentasi tidak ditemukan.';
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
