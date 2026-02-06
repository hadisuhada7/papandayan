@extends('front.layouts.app')

@section('title', 'Beranda')

@section('content')

    <!--banner start-->
    @forelse ($banners as $banner)
        <section class="w-100 clearfix poultryPerformanceBanner" id="poultryPerformanceBanner" style="background-image: url('{{ Storage::url($banner->banner) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7">
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="poultryPerformanceHeading">
                            <h1>{{ $banner->heading }}</h1>
                            <p>{{ $banner->subheading }}</p>
                            <a class="btn btn-1 hover-slide-down" href="{{ $banner->link }}">
                                <span>Selengkapnya <img src="{{ asset('images/icon/icon-black-right.png') }}" alt="icon" class="img-fluid"></span>
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
                                            <div class="cartPara">
                                                <p style="margin-top: 5px;">{{ $statistic->description }}</p>
                                             </div>
                                        </div>
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

    <!--about us sec1 start-->
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
                                        <img src="{{ asset('images/icon7.png') }}" alt="Broiler-Breeder" class="img-fluid">
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
                                                <img src="{{ asset('images/icon8.png') }}" alt="Broiler-Breeder" class="img-fluid">
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

    <!--latest news & articles start-->
    <section class="w-100 clearfix latestNewsArticles" id="latestNewsArticles">
        <div class="container">
            <div class="latestNewsArticlesInner">
                <div class="commonHeading">
                    <h4 class="fadein">Berita & Artikel Terbaru</h4>
                    <p class="fadein">Beragam informasi seputar aktivitas perusahaan mencakup kegiatan internal, rangkaian event, dan berita terbaru untuk seluruh pemangku kepentingan</p>
                </div>
                <div class="latestNewsCard">
                    <div class="row">

                        @forelse ($articles as $article)
                            <div class="col-md-12 col-lg-4">
                                <div class="latestNewsCardInner fadein">
                                    <div class="latestNewsCardImg">
                                        <a href="{{ route('front.article-detail', $article->id) }}"><img src="{{ Storage::url($article->thumbnail) }}" alt="img" class="w-100 img-fluid"></a>
                                        <div class="latestNewsDate">
                                            <a href="javascript:void(0);">
                                                <h5>{{ $article->publish_at->format('d') }}</h5>
                                                <span>{{ $article->publish_at->format('M') }}</span>
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
                                                    <i class="fa fa-eye" style="color: #3c5fac;"></i><span>{{ $article->viewer }} Viewers</span>
                                                </a>
                                            </div>
                                            @include('front.partials.like-post', ['model' => $article, 'type' => 'article'])
                                        </div>
                                        <div class="latestNewsTxt">
                                            <h4><a href="{{ route('front.article-detail', $article->id) }}">{{ $article->title }}</a></h4>
                                            <p>{{ $article->subtitle }}</p>
                                        </div>
                                        <div class="latestNewBtn">
                                            <a class="btnCustom2 btn-1 hover-slide-down" href="{{ route('front.article-detail', $article->id) }}">
                                                <span>Selengkapnya <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
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
            <p class="fadein">Papandayan Inti Plasma beroperasi di berbagai wilayah Jawa Barat dengan komitmen membangun kemitraan budidaya ayam broiler yang berkelanjutan</p>
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
