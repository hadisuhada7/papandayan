@extends('front.layouts.app')

@section('title', 'K3')

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
                <li><a>K3</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->
   
    <!--article single start-->
    <section class="w-100 clearfix blogSingle" id="blogSingle">
        <div class="container">
            <div class="blogSingleInner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blogSingleBlog">
                            <div class="latestNewsCardInner">
                                <div class="latestNewsCardInnerContent">

                                    @if($safeties)
                                        <div class="latestNewsTxt">
                                            <h4><a href="javascript:void(0);">{{ $safeties->title }}</a></h4>
                                            <div>{!! $safeties->about !!}</div>
                                        </div>
                                    @else
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--article single end-->

@endsection

@push('after-styles')
    <style>
        /* Restore list styling for content */
        .latestNewsTxt ul {
            list-style-type: disc;
            padding-left: 40px;
            margin: 15px 0;
        }
        
        .latestNewsTxt ol {
            list-style-type: decimal;
            padding-left: 40px;
            margin: 15px 0;
        }
        
        .latestNewsTxt li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
    </style>
@endpush

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