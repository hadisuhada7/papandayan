@extends('front.layouts.app')

@section('title', 'Beranda')

@section('content')
   
   <!--banner start-->
    @forelse ($banners as $banner)
        <section class="w-100 clearfix poultryPerformanceBanner" id="poultryPerformanceBanner"
            style="background-image: url('{{ Storage::url($banner->banner) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7">
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="poultryPerformanceHeading">
                            <h1>{{ $banner->heading }}</h1>
                            <p>{{ $banner->subheading }}</p>
                            <a class="btn btn-1 hover-slide-down" href="{{ $banner->link }}">
                                <span>Read More <img src="{{ asset('images/icon/icon-black-right.png') }}" alt="icon" class="img-fluid"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @empty
        
    @endforelse
    <!--banner end-->

    <!--statistic start-->
    <section class="w-100 clearfix categorySec ourServiceCategory" id="ourServiceCategory">
        <div class="container">
            <div class="categorySecInner">
                <div class="row">

                    @forelse ($statistics as $statistic)
                        <div class="col-sm-6 col-lg-3">
                            <a href="javascript:void(0);">
                                <div class="customersTalkingCart fadein">
                                    <div class="customersTalkingHead">
                                        <div class="customersTalkingIcon">
                                            <span>
                                                <img src="{{ Storage::url($statistic->icon) }}" alt="icon" class="img-fluid">
                                            </span>
                                        </div>
                                        <div class="customersTalkingHeading">
                                            <span>{{ $statistic->goal }}</span>
                                            <h6>{{ $statistic->name }}</h6>
                                            <!-- <p>{{ $statistic->description }}</p> -->
                                            <div class="cartPara">
                                                <p style="margin-top: 5px;">{{ $statistic->description }}</p>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="cartPara">
                                        <!-- <p style="margin-top: 5px;">{{ $statistic->description }}</p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        
                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!--statistic end-->

   <!-- about us sec1 start-->
   <section class="w-100 clearfix aboutUsSec1" id="aboutUsSec1">
      <div class="container">
        
        @forelse ($products as $product)
        <div class="row aboutUsRow1">
            <div class="col-xl-6 aboutUsCol1">
               <div class="aboutUsSec2Img">
                  <img src="{{ Storage::url($product->thumbnail) }}" alt="" class="img-fluid">
               </div>  
            </div>  
            <div class="col-xl-6 aboutUsCol1">
               <div class="aboutUsSec1Content">
                  <div class="aboutUsSec1Para">
                     <div class="broilerBreederHeadGroup">
                        <div class="broilBreederImg">
                           <img src="{{ asset('images/icon7.png') }}" alt="Broiler-Breeder" class="img-fluid">
                        </div>
                        <div class="broilBreederHeading">
                           <h2 class="mb-0">{{ $product->name }}</h2>
                        </div>
                     </div>
                     <p>{{ $product->about }}</p>
                     <!-- <p>We are uncompromising in our control and monitoring of the production cycle. From the arrival of chicks/raw material to dispatch to our customers, biosecurity measures are stringently followed.</p>
                     <ul>
                        <li>it look like readable English. Many desktop publishing packages.</li>
                        <li>Richard McClintock, a Latin professor at Hampden-Sydney College</li>
                        <li>I will give you a complete account of the system</li>
                        <li>On the other hand, we denounce with righteous indignation and dislike men</li>
                     </ul> -->
                  </div> 
                  <a href="{{ $product->link_whatsapp }}" class="btnCustom5 btn-1 hover-slide-down">
                              <span>Hubungi Kami <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                           </a>
               </div> 
            </div>   
        </div>
        @empty
        
        @endforelse

      </div>
   </section>
   <!--about us sec1 end-->

   <!--broiler breeder start-->
   <section class="w-100 clearfix broilerBreeder" id="broilerBreeder">
      <div class="broilerBreederInner">

        @forelse ($services as $service)
        <div class="pigFactsTopics">
            <div class="pigFactsTopicsRow">
               <div class="pigFactsTopicsCol pigFactsTopicsCol1 order-xl-2">
                  <div class="pigFactsImg">
                     <img src="{{ Storage::url($service->thumbnail) }}" alt="img" class="img-fluid">
                  </div>
               </div>
               <div class="pigFactsTopicsCol pigFactsTopicsCol2 order-xl-1">
                  <div class="pigFactsTxt">
                     <div class="pigFactsTxtInner">
                        <div class="broilerBreederContent">
                           <div class="broilerBreederHeadGroup">
                              <div class="broilBreederImg">
                                 <img src="{{ asset('images/icon8.png') }}" alt="Broiler-Breeder" class="img-fluid">
                              </div>
                              <div class="broilBreederHeading">
                                 <h2 class="mb-0">{{ $service->name }}</h2>
                              </div>
                           </div>
                           <div class="broilerBreederPara">
                              <p>{{ $service->about }}</p>

                              @if($service->keypoints && count($service->keypoints) > 0)
                              <ul>
                                 @foreach ($service->keypoints as $keypoint)
                                    @if(!empty($keypoint->keypoint))
                                    <li>{{ $keypoint->keypoint }}</li>
                                    @endif
                                 @endforeach
                              </ul>
                              @endif

                              <!-- <p class="paraBold">We are uncompromising in our control and monitoring of the production cycle. From the arrival of chicks/raw material to dispatch to our customers, biosecurity measures are stringently followed.</p> -->
                           </div>

                           <a href="{{ $service->link_whatsapp }}" class="btnCustom5 btn-1 hover-slide-down">
                              <span>Hubungi Kami <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
        @empty
        
        @endforelse

      </div>
   </section>
   <!--broiler breeder end-->

   <!--gallery pig farm start-->
   <!-- <section class="w-100 clearfix galleryPigFarm" id="galleryPigFarm">
      <div class="container">
         <div class="commonHeading">
            <h4 class="fadein">Gallery Of Our Pig Farm</h4>
            <p class="fadein">It is a long established fact that a reader will be distracted by the readable content of
               a page when looking at its layout. The point of using Lorem Ipsum</p>
         </div>
         <div class="galleryColumn p-0">
            <div class="row galleryRow">
               <div class="col-md-4 col-sm-6 galleryCol">
                  <div class="galleryItem fadein">
                     <a href="{{ asset('images/gallery/img7.png') }}" class="galleryLink" data-fancybox="images" data-caption="">
                        <div class="promo image">
                           <img src="{{ asset('images/gallery/img7.png') }}" alt="galley-img" class="img-fluid">
                           <div class="caption">
                              <div class="plusIcon"><img src="{{ asset('images/icon/plus-icon.png') }}" alt="plus-img"
                                    class="img-fluid"></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 galleryCol">
                  <div class="galleryItem fadein">
                     <a href="{{ asset('images/gallery/img8.png') }}" class="galleryLink" data-fancybox="images" data-caption="">
                        <div class="promo image">
                           <img src="{{ asset('images/gallery/img8.png') }}" alt="galley-img" class="img-fluid">
                           <div class="caption">
                              <div class="plusIcon"><img src="{{ asset('images/icon/plus-icon.png') }}" alt="plus-img"
                                    class="img-fluid"></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 galleryCol">
                  <div class="galleryItem fadein">
                     <a href="{{ asset('images/gallery/img9.png') }}" class="galleryLink" data-fancybox="images" data-caption="">
                        <div class="promo image">
                           <img src="{{ asset('images/gallery/img9.png') }}" alt="galley-img" class="img-fluid">
                           <div class="caption">
                              <div class="plusIcon"><img src="{{ asset('images/icon/plus-icon.png') }}" alt="plus-img"
                                    class="img-fluid"></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 galleryCol">
                  <div class="galleryItem fadein">
                     <a href="{{ asset('images/gallery/img10.png') }}" class="galleryLink" data-fancybox="images" data-caption="">
                        <div class="promo image">
                           <img src="{{ asset('images/gallery/img10.png') }}" alt="galley-img" class="img-fluid">
                           <div class="caption">
                              <div class="plusIcon"><img src="{{ asset('images/icon/plus-icon.png') }}" alt="plus-img"
                                    class="img-fluid"></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 galleryCol">
                  <div class="galleryItem fadein">
                     <a href="{{ asset('images/gallery/img11.png') }}" class="galleryLink" data-fancybox="images" data-caption="">
                        <div class="promo image">
                           <img src="{{ asset('images/gallery/img11.png') }}" alt="galley-img" class="img-fluid">
                           <div class="caption">
                              <div class="plusIcon"><img src="{{ asset('images/icon/plus-icon.png') }}" alt="plus-img"
                                    class="img-fluid"></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 galleryCol">
                  <div class="galleryItem fadein">
                     <a href="{{ asset('images/gallery/img12.png') }}" class="galleryLink" data-fancybox="images" data-caption="">
                        <div class="promo image">
                           <img src="{{ asset('images/gallery/img12.png') }}" alt="galley-img" class="img-fluid">
                           <div class="caption">
                              <div class="plusIcon"><img src="{{ asset('images/icon/plus-icon.png') }}" alt="plus-img"
                                    class="img-fluid"></div>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section> -->
   <!--gallery pig farm end-->

   <!--testimonials box start-->
   <section class="w-100 clearfix testimonialsBox" id="testimonialsBox">
      <div class="testimonialsRow">
         <div class="testimonialsCol testimonialsCol1">
            <h4 class="fadein">TESTIMONI</h4>
            <h2 class="fadein">Pengalaman peternak dalam bermitra</h2>
            <a class="btn btn-1 hover-slide-down mt-3 fadein" href="javascript:void(0);">
               <span>Selengkapnya <img src="{{ asset('images/icon/icon-black-right.png') }}" alt="icon" class="img-fluid"></span>
            </a>
         </div>
         <div class="testimonialsCol testimonialsCol2">

            @forelse ($testimonials as $testimonial)
            <div class="testimonialSlider">
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="slide_{{ $testimonial->id }}">
                     <div class="testimonialSliderItem fadein">
                        <p>{{ $testimonial->message }}</p>
                        <h4>{{ $testimonial->name }}</h4>
                        <span>{{ $testimonial->occupation }}</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="testimonialSliderImg">
               <!-- Nav pills -->
               <ul class="nav nav-pills fadein">
                  <li class="nav-item">
                     <a class="nav-link active" data-bs-toggle="pill" href="#slide_{{ $testimonial->id }}">
                        <img src="{{ Storage::url($testimonial->avatar) }}" alt="icon" class="img-fluid">
                     </a>
                  </li>
               </ul>
            </div>
            @empty
            
            @endforelse

         </div>
      </div>

   </section>
   <!--testimonials box end-->

   <!--latest news & articles start-->
   <section class="w-100 clearfix latestNewsArticles" id="latestNewsArticles">
      <div class="container">
         <div class="latestNewsArticlesInner">
            <div class="commonHeading">
               <h4 class="fadein">Artikel</h4>
               <p class="fadein">Beragam informasi seputar aktivitas perusahaan, mulai dari kegiatan internal, rangkaian event, serta berita terbaru perusahaan untuk seluruh pemangku kepentingan</p>
            </div>
            <div class="latestNewsCard">
               <div class="row">

                  @forelse ($articles as $article)
                  <div class="col-md-12 col-lg-4">
                     <div class="latestNewsCardInner fadein">
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
                                    <i class="fa fa-user" style="color: #3c5fac;"></i><span>{{ $article->author }}</span>
                                 </a>
                              </div>
                              <div class="latestNewsUser">
                                 <a href="javascript:void(0);">
                                    <i class="fa fa-eye" style="color: #3c5fac;"></i><span>{{ $article->viewer }}
                                       </span>
                                 </a>
                              </div>
                           </div>
                           <div class="latestNewsTxt">
                              <h4><a href="{{ route('front.article-detail', $article->id) }}">{{ $article->title }}</a></h4>
                              <p>{{ $article->subtitle }}</p>
                           </div>
                           <div class="latestNewBtn">
                              <a class="btnCustom5 btn-1 hover-slide-down" href="{{ route('front.article-detail', $article->id) }}">
                                 <span>Selengkapnya <img src="{{ asset('images/icon/icon-right.png') }}" alt="right"
                                       class="img-fluid"></span>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @empty
                  
                  @endforelse

               </div>
               <div class="latestNewsCardBtn fadein">
                  <a class="btnCustom2 btn-1 hover-slide-down" href="{{ route('front.articles') }}">
                     <span>Selengkapnya <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                  </a>
               </div>
            </div>
         </div>

      </div>
   </section>
   <!--latest news & articles end-->

   <!--maps section start-->
   <section class="w-100 clearfix mapsSection" id="mapsSection">
      <div class="commonHeading text-center">
         <h4 class="fadein">Wilayah Persebaran</h4>
         <p class="fadein">Papandayan Inti Plasma memiliki persebaran wilayah operasional yang mencakup berbagai daerah di Jawa Barat, sebagai bagian dari komitmen dalam membangun kemitraan budidaya ayam broiler yang berorientasi pada pertumbuhan bersama.</p>
      </div>
      <div class="container">
         <div class="mapsSectionInner fadein">
            <div class="mapOverlay">
               <div id="map"></div>
            </div>
         </div>
      </div>
   </section>
   <!--maps section end-->

   

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

      // Initialize Leaflet Maps
      var map = L.map('map').setView([-6.9175, 107.6191], 10); // Center on Bandung, West Java

      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
         maxZoom: 19,
         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);

      // Add coverage area markers
      @if(isset($coverageAreas) && count($coverageAreas) > 0)
         @foreach($coverageAreas as $area)
            @if($area->latitude && $area->longitude)
            L.marker([{{ $area->latitude }}, {{ $area->longitude }}]).addTo(map)
               .bindPopup('<b>{{ $area->partner_name }}</b><br/>Jumlah Kandang: {{ $area->number_of_cages }}');
            @endif
         @endforeach
      @endif

   </script>
@endpush