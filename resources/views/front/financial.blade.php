@extends('front.layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')

   <!--banner sec start-->
   <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
      <div class="container">
         <div class="bannerContent">
            <h1>Laporan Keuangan</h1>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
               <li class="breadcrumb-item active">Laporan Keuangan</li>
            </ul>
         </div>
      </div>
   </section>
   <!--banner sec end-->
   
   <!--blog section start-->
   <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
      <div class="container">
         <div class="blogArticlesInner">
            <div class="latestNewsCard">
               <div class="row blogWithSidebarRow">

                  @forelse ($financials as $financial)
                  <div class="col-md-12 col-lg-12 blogWithSidebarCol">
                     <div class="latestNewsCardInner mb-4 file-list">
                        <div class="list">
                           <div class="list-date"> 
                              <h6>{{ $financial->publish_at->format('d F Y') }}</h6> 
                           </div>
                           <div class="list-field">
                              <h5>{{ $financial->title }}</h5>
                              <div class="download-file"> 
                                 @forelse ($financial->financialReports as $report)
                                  <div class="file-list">
                                       <h6>{{ $report->name }}</h6>
                                                   <a href="{{ Storage::url($report->report) }}" target="_blank" class="link link-download">Unduh PDF</a>
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
   </style>
@endpush

@push('after-scripts')
   <script>
      $(document).ready(function ($) {

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