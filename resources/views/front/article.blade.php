@extends('front.layouts.app')

@section('title', 'Article')

@section('content')

   <!--banner sec start-->
   <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
      <div class="container">
         <div class="bannerContent">
            <h1>Article</h1>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
               <li class="breadcrumb-item active">Article</li>
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

                  @forelse ($articles as $article)
                  <div class="col-md-12 col-lg-4 blogWithSidebarCol">
                     <div class="latestNewsCardInner mb-4">
                        <div class="latestNewsCardImg">
                           <a href="{{ route('front.article-detail', $article->id) }}"><img src="{{ Storage::url($article->thumbnail) }}" alt="img"
                                 class="w-100 img-fluid"></a>
                           <div class="latestNewsDate">
                              <a href="javascript:void(0);">
                                 <h5>{{ $article->created_at->format('d') }}</h5>
                                 <span>{{ $article->created_at->format('M') }}</span>
                              </a>
                           </div>
                        </div>
                        <div class="latestNewsCardInnerContent">
                           <div class="latestNewsList">
                              <div class="latestNewsUser">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/icon/user.png') }}" alt="icon" class="img-fluid"><span>{{ $article->author }}</span>
                                 </a>
                              </div>
                              <div class="latestNewsMessage">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/icon/message.png') }}" alt="icon" class="img-fluid"><span>{{ $article->viewer }}</span>
                                 </a>
                              </div>
                           </div>
                           <div class="latestNewsTxt">
                              <h4><a href="{{ route('front.article-detail', $article->id) }}">{{ $article->title }}</a></h4>
                              <p>{{ $article->subtitle }}</p>
                           </div>
                           <div class="latestNewBtn">
                              <a class="btnCustom5 btn-1 hover-slide-down" href="{{ route('front.article-detail', $article->id) }}">
                                 <span>Read More <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
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