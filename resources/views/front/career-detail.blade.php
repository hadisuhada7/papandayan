@extends('front.layouts.app')

@section('title', 'Career Detail')

@section('content')

   <!--banner sec start-->
   <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
      <div class="container">
         <div class="bannerContent">
            <h1>Karir</h1>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
               <li class="breadcrumb-item active">Detail Karir</li>
            </ul>
         </div>
      </div>
   </section>
   <!--banner sec end-->

   <!--blog single start-->
   <section class="w-100 clearfix blogSingle" id="blogSingle">
      <div class="container">
         <div class="blogSingleInner">
            <div class="row">
               <div class="col-lg-8">

                  <div class="blogSingleBlog">
                     <div class="latestNewsCardInner">
                        
                        <!--comment box-->
                        <div class="commentBox">
                           <div class="commentBoxInner">
                              <div class="commentBoxHeading">
                                 <h4>{{ $career->position }}</h4>
                                 <p>Penempatan: {{ $career->location }}</p>
                                 <p>Batas Waktu: {{ $career->closing_at->locale('id')->isoFormat('D MMMM Y') }}</p>
                                 <p>Kualifikasi: {!! $career->qualification !!}</p>
                                 <p>Deskripsi Pekerjaan: {!! $career->description !!}</p>
                              </div>
                              <div class="commentBoxForm">
                                 <a href="{{ route('front.career-form', $career->id) }}" class="btnCustom5 btn-1 hover-slide-down"><span>Apply <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></a>
                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <!-- <div class="blogSingleAside">
                     <div class="searchKeyword customCard">
                        <div class="searchKeywordInner">
                           <h4>Search Keyword</h4>
                           <h6>Search</h6>
                           <form>
                              <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search here" value="">
                                 <button type="submit" class="input-group-text"><img src="{{ asset('images/icon/search.png') }}" alt="search" class="img-fluid"></button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="recentPost customCard">
                        <h4>Recent Post</h4>
                        <div class="recentPostList">
                           <div class="recentPostGroupList">
                              <a href="javascript:void(0);">
                                 <div class="recentPostImg">
                                    <img src="{{ asset('images/img40.png') }}" alt="recentPost" class="img-fluid">
                                 </div>
                                 <div class="recentPostTxt">
                                    <p>Seamlessly fashion customiz before.</p>
                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> 8 April 2023</span>
                                 </div>
                              </a>
                           </div>
                           <div class="recentPostGroupList">
                              <a href="javascript:void(0);">
                                 <div class="recentPostImg">
                                    <img src="{{ asset('images/img41.png') }}" alt="recentPost" class="img-fluid">
                                 </div>
                                 <div class="recentPostTxt">
                                    <p>Know the Benefit Of Boiled Egg</p>
                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> 9 April 2023</span>
                                 </div>
                              </a>
                           </div>
                           <div class="recentPostGroupList">
                              <a href="javascript:void(0);">
                                 <div class="recentPostImg">
                                    <img src="{{ asset('images/img42.png') }}" alt="recentPost" class="img-fluid">
                                 </div>
                                 <div class="recentPostTxt">
                                    <p>Seamlessly fashion customiz before.</p>
                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> 10 April 2023</span>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="popularTags customCard">
                        <h4>Popular Tags</h4>
                        <div class="tagGroup">
                           <ul class="nav">
                              <li class="nav-item">
                                 <a class="nav-link tag tagActive" href="javascript:void(0);">Poultry</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Travel</a>
                              </li>  
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Breeder</a>
                              </li>    
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Feed</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Chicks</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--blog single end-->

@endsection

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