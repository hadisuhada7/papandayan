@extends('front.layouts.app')

@section('title', 'Career')

@section('plugins.Toastr', true)

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
            <li><a>Karir</a></li>
         </ul>
      </div>
   </div>

   <!--blog section start-->
   <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
      <div class="container">
         <div class="blogArticlesInner">
            <div class="latestNewsCard">
               <div class="row blogWithSidebarRow">

                  @forelse($careers as $career)
                  <div class="col-md-12 col-lg-4 blogWithSidebarCol">
                     <div class="latestNewsCardInner mb-4">
                        <!-- <div class="latestNewsCardImg">
                           <a href="blog-single.html"><img src="{{ asset('images/img22.png') }}" alt="img"
                                 class="w-100 img-fluid"></a>
                           <div class="latestNewsDate">
                              <a href="javascript:void(0);">
                                 <h5>{{ $career->created_at->format('d') }}</h5>
                                 <span>{{ $career->created_at->format('M') }}</span>
                              </a>
                           </div>
                        </div> -->
                        <div class="latestNewsCardInnerContent">
                           <div class="latestNewsList">
                              <div class="latestNewsUser">
                                 <a href="javascript:void(0);">
                                    <i class="fa fa-briefcase" style="color: #3c5fac;"></i><span>{{ $career->work_type }}</span>
                                 </a>
                              </div>
                              <div class="latestNewsUser">
                                 <a href="javascript:void(0);">
                                    <i class="fa fa-user" style="color: #3c5fac;"></i><span>{{ $career->work_experience }}
                                       </span>
                                 </a>
                              </div>
                           </div>
                           <div class="latestNewsTxt">
                              <h4><a href="{{ route('front.career-detail', $career->id) }}">{{ $career->position }}</a></h4>
                              <p>Penempatan: {{ $career->location }}
                              <br>Batas Waktu: {{ $career->closing_at->locale('id')->isoFormat('D MMMM Y') }}</p>
                           </div>
                           <div class="latestNewBtn">
                              <a class="btnCustom5 btn-1 hover-slide-down" href="{{ route('front.career-detail', $career->id) }}">
                                 <span>Selengkapnya <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                              </a>
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

@push('after-scripts')
   @include('partials.toastr')

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