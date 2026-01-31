@extends('front.layouts.app')

@section('title', 'Bisnis Kami')

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
    <ul>
        <li><a href="{{ route('front.index') }}">Beranda</a></li>
         <li><a>Bisnis Kami</a></li>
      </ul>
   </div>

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

                              @forelse ($service->keypoints as $keypoint)
                              <ul>
                                 <li>it look like readable English. Many desktop publishing packages.</li>
                                 <!-- <li>Richard McClintock, a Latin professor at Hampden-Sydney College</li>
                                 <li>I will give you a complete account of the system</li>
                                 <li>On the other hand, we denounce with righteous indignation and dislike men</li> -->
                              </ul>
                              @empty
                              
                              @endforelse

                              <!-- <p class="paraBold">We are uncompromising in our control and monitoring of the production cycle. From the arrival of chicks/raw material to dispatch to our customers, biosecurity measures are stringently followed.</p> -->
                           </div>
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

   <!--testimonials box start-->
   <section class="w-100 clearfix testimonialsBox" id="testimonialsBox" style="margin-bottom: 100px;">
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