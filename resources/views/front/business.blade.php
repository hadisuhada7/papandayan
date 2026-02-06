@extends('front.layouts.app')

@section('title', 'Bisnis Kami')

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
                <li><a>Bisnis Kami</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->

    <!-- about us sec1 start-->
    <section class="w-100 clearfix aboutUsSec1" id="aboutUsSec1">
        <div class="container">
        
            @forelse ($products as $product)
                <div class="row aboutUsRow1">
                    <div class="col-xl-6 aboutUsCol1">
                        <div class="aboutUsSec2Img">
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="thumbnail" class="img-fluid">
                        </div>  
                    </div>  
                    <div class="col-xl-6 aboutUsCol1">
                        <div class="aboutUsSec1Content">
                            <div class="aboutUsSec1Para">
                                <div class="broilerBreederHeadGroup">
                                    <div class="broilBreederImg">
                                        <img src="{{ Storage::url($product->icon) }}" alt="Broiler-Breeder" class="img-fluid">
                                    </div>
                                    <div class="broilBreederHeading">
                                        <h2 class="mb-0">{{ $product->name }}</h2>
                                    </div>
                                </div>
                                <p>{!! $product->about !!}</p>
                                <br>
                            </div> 
                            <div class="latestNewsCardBtn fadein">
                                <a class="btnCustom2 btn-1 hover-slide-down" href="{{ $product->link_whatsapp }}">
                                    <span>Hubungi Kami <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                                </a>
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
                                                <img src="{{ Storage::url($service->icon) }}" alt="Broiler-Breeder" class="img-fluid">
                                            </div>
                                            <div class="broilBreederHeading">
                                                <h2 class="mb-0">{{ $service->name }}</h2>
                                            </div>
                                        </div>
                                        <div class="broilerBreederPara">
                                            <p>{!! $service->about !!}</p>

                                            @if($service->keypoints && count($service->keypoints) > 0)
                                                <ul>
                                                    @foreach ($service->keypoints as $keypoint)
                                                        @if(!empty($keypoint->keypoint))
                                                            <li>{{ $keypoint->keypoint }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif

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

    <!--testimonials box start-->
    <section class="w-100 clearfix testimonialsBox" id="testimonialsBox">
        <div class="testimonialsRow">
            <div class="testimonialsCol testimonialsCol1">
                <h4 class="fadein">TESTIMONI</h4>
                <h2 class="fadein">Pengalaman Peternak Dalam Bermitra</h2>
                <a class="btn btn-1 hover-slide-down mt-3 fadein" href="javascript:void(0);">
                    <span>Selengkapnya <img src="{{ asset('images/icon/icon-black-right.png') }}" alt="icon" class="img-fluid"></span>
                </a>
            </div>
            <div class="testimonialsCol testimonialsCol2">

                @if(isset($testimonials) && $testimonials->count())
                    <div class="testimonialSlider">
                        <div class="tab-content">
                            @foreach ($testimonials as $testimonial)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slide_{{ $testimonial->id }}">
                                    <div class="testimonialSliderItem fadein">
                                        <p>{{ $testimonial->message }}</p>
                                        <h4>{{ $testimonial->name }}</h4>
                                        <span>{{ $testimonial->occupation }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="testimonialSliderImg">
                        <ul class="nav nav-pills fadein">
                            @foreach ($testimonials as $testimonial)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill" href="#slide_{{ $testimonial->id }}">
                                        <img src="{{ Storage::url($testimonial->avatar) }}" alt="icon" class="img-fluid">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!--testimonials box end-->

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function ($) {
            // Script here
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