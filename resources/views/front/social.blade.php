@extends('front.layouts.app')

@section('title', 'CSR')

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
                <li><a href="javascript:void(0);">Keberlanjutan</a></li>
                <li><a>CSR</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->
   
    <!--all article start-->
    <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
        <div class="container">
            <div class="blogArticlesInner">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="latestNewsCard">
                            <div class="row blogWithSidebarRow">

                                @forelse ($socials as $social)
                                    <div class="col-md-12 col-lg-6 blogWithSidebarCol">
                                        <div class="latestNewsCardInner mb-4 fadein">
                                            <div class="latestNewsCardImg">
                                                <a href="{{ route('front.social-detail', $social->slug) }}"><img src="{{ Storage::url($social->thumbnail) }}" alt="img" class="w-100 img-fluid"></a>
                                                <div class="latestNewsDate">
                                                    <a href="javascript:void(0);">
                                                        <h5>{{ $social->publish_at->locale('id')->isoFormat('DD') }}</h5>
                                                        <span>{{ $social->publish_at->locale('id')->isoFormat('MMM') }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="latestNewsCardInnerContent">
                                                <div class="latestNewsList">
                                                    <div class="latestNewsUser">
                                                        <a href="javascript:void(0);">
                                                            <i class="fa fa-user" style="color: #3c5fac;"></i><span>{{ $social->author }}</span>
                                                        </a>
                                                    </div>
                                                    <div class="latestNewsUser">
                                                        <a href="javascript:void(0);">
                                                            <i class="fa fa-eye" style="color: #3c5fac;"></i><span>{{ $social->viewer }} Viewers</span>
                                                        </a>
                                                    </div>

                                                    @include('front.partials.like-post', ['model' => $social, 'type' => 'social'])

                                                </div>
                                                <div class="latestNewsTxt">
                                                    <h4><a href="{{ route('front.social-detail', $social->slug) }}">{{ $social->title }}</a></h4>
                                                    <p>{{ $social->subtitle }}</p>
                                                </div>
                                                <div class="latestNewBtn">
                                                    <a class="btnCustom2 btn-1 hover-slide-down" href="{{ route('front.social-detail', $social->slug) }}">
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

                        {{ $socials->links('front.partials.pagination') }}

                    </div>
                    <div class="col-lg-4">
                        <div class="blogSingleAside">

                            @include('front.partials.search-post', [
                                'title' => 'Temukan CSR',
                                'placeholder' => 'Search',
                                'action' => route('front.socials'),
                            ])

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--all article end-->

@endsection

@push('after-scripts')
    <script>
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
