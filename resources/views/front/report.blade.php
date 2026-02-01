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
            
            <div class="paginationGroup">
               <ul class="pagination">
                  <li class="page-item"><a class="page-link pageLinkPrev" href="#"><img src="{{ asset('images/icon/arrow-left.png') }}" alt="arrow left" class="img-fluid"></a></li>
                  <li class="page-item"><a class="page-link active" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item"><a class="page-link" href="#">6</a></li>
                  <li class="page-item"><a class="page-link pageLinkNext" href="#"><img src="{{ asset('images/icon/arrow-right.png') }}" alt="arrow right" class="img-fluid"></a></li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <!--blog section end-->
@endsection

@push('after-scripts')
   <script>
      $(document).ready(function () {
         console.log('=== Report page - Modal download initialized ===');
         
         let selectedReportId = null;
         let selectedReportName = '';

         // Open modal when download button clicked
         $(document).on("click", ".item-download", function(e){
             e.preventDefault();
             
             selectedReportId = $(this).data("id");
             selectedReportName = $(this).closest('.latestNewsCardInner').find('.latestNewsTxt h4 a').text();
             
             console.log('Download clicked - ID:', selectedReportId, 'Name:', selectedReportName);
             
             $("#report-name").text(selectedReportName);
             $('#download-form')[0].reset();
             $('.invalid-feedback').text('');
             $('.form-control').removeClass('is-invalid');
             
             $("#modal-download").modal("show");
         });

         // Submit form and download
         $(document).on("click", "#btn-modal-download", function(e){
             e.preventDefault();
             console.log('\n=== SUBMIT BUTTON CLICKED ===');
             console.log('Report ID:', selectedReportId);
             
             if(!selectedReportId) {
                 console.error('ERROR: No report ID');
                 alert('Error: Tidak ada laporan yang dipilih');
                 return;
             }
             
             // Get values
             var name = $('#modal-name').val().trim();
             var email = $('#modal-email').val().trim();
             
             console.log('Form values:', {name: name, email: email});
             
             // Basic validation
             if(!name) {
                 console.log('Validation failed: name empty');
                 $('#modal-name').addClass('is-invalid');
                 $('#name-error').text('Nama harus diisi').show();
                 return;
             }
             
             if(!email) {
                 console.log('Validation failed: email empty');
                 $('#modal-email').addClass('is-invalid');
                 $('#email-error').text('Email harus diisi').show();
                 return;
             }
             
             console.log('Validation passed');
             
             // Disable button
             var $btn = $(this);
             $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
             
             // Get CSRF token
             var csrfToken = $('meta[name="csrf-token"]').attr('content');
             if (!csrfToken) {
                 csrfToken = $('#download-form input[name="_token"]').val();
             }
             console.log('CSRF Token:', csrfToken ? 'Found' : 'NOT FOUND');
             
             // Build URL
             var submitUrl = "{{ route('front.report.download.with.log', ':id') }}".replace(':id', selectedReportId);
             console.log('Submit URL:', submitUrl);
             
             // Prepare data
             var formData = {
                 _token: csrfToken,
                 name: name,
                 email: email
             };
             console.log('Sending data:', formData);
             
             // Send AJAX
             console.log('Sending AJAX request...');
             $.ajax({
                 url: submitUrl,
                 type: 'POST',
                 data: formData,
                 dataType: 'json',
                 success: function(response) {
                     console.log('\n=== SUCCESS ===');
                     console.log('Response:', response);
                     console.log('IP Address tersimpan:', response.ip_address);
                     console.log('Log ID:', response.log_id);
                     
                     // Hide modal
                     $("#modal-download").modal("hide");
                     
                     // Show success message with IP
                     console.log('Data saved! Starting download...');
                     console.log('Your IP:', response.ip_address);
                     
                     // Trigger download
                     var downloadUrl = "{{ route('front.report.download', ':id') }}".replace(':id', selectedReportId);
                     console.log('Download URL:', downloadUrl);
                     
                     // Create hidden iframe for download
                     var iframe = document.createElement('iframe');
                     iframe.style.display = 'none';
                     iframe.src = downloadUrl;
                     document.body.appendChild(iframe);
                     
                     setTimeout(function() {
                         document.body.removeChild(iframe);
                     }, 5000);
                     
                     // Reset button
                     $btn.prop('disabled', false).html('Kirim');
                 },
                 error: function(xhr, status, error) {
                     console.log('\n=== ERROR ===');
                     console.log('Status:', xhr.status);
                     console.log('Response:', xhr.responseText);
                     console.log('Error:', error);
                     
                     var errorMsg = 'Terjadi kesalahan!';
                     
                     if (xhr.status === 422) {
                         console.log('Validation error from server');
                         try {
                             var errors = JSON.parse(xhr.responseText);
                             if (errors.errors) {
                                 errorMsg = Object.values(errors.errors).flat().join('\n');
                             }
                         } catch(e) {
                             console.log('Error parsing response:', e);
                         }
                     } else if (xhr.status === 419) {
                         errorMsg = 'CSRF token mismatch. Silakan refresh halaman.';
                     } else if (xhr.status === 404) {
                         errorMsg = 'Laporan tidak ditemukan.';
                     } else if (xhr.status === 500) {
                         errorMsg = 'Server error. Silakan coba lagi.';
                     } else {
                         errorMsg = 'Error ' + xhr.status + ': ' + error;
                     }
                     
                     alert(errorMsg);
                     
                     // Reset button
                     $btn.prop('disabled', false).html('Kirim');
                 }
             });
         });

         // Clear errors on input
         $('#modal-name, #modal-email').on('input', function() {
             $(this).removeClass('is-invalid');
             $(this).siblings('.invalid-feedback').hide();
         });

         // Reset on modal close
         $('#modal-download').on('hidden.bs.modal', function () {
             $('#download-form')[0].reset();
             $('.invalid-feedback').text('').hide();
             $('.form-control').removeClass('is-invalid');
             $('#btn-modal-download').prop('disabled', false).html('Kirim');
         });

         // Clear validation errors on input
         $('#modal-name, #modal-email').on('input', function() {
             $(this).removeClass('is-invalid');
             $(this).siblings('.invalid-feedback').text('');
         });

         // Modal shown event
         $('#modal-download').on('shown.bs.modal', function () {
             console.log('Modal is now visible');
             $('#modal-name').focus();
         });

         // Modal hidden event
         $('#modal-download').on('hidden.bs.modal', function () {
             console.log('Modal is now hidden');
             // Reset form
             $('#download-form')[0].reset();
             $('.invalid-feedback').text('');
             $('.form-control').removeClass('is-invalid');
             $('#btn-modal-download').prop('disabled', false).text('Kirim');
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