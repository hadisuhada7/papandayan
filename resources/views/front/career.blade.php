@extends('front.layouts.app')

@section('title', 'Karir')

@section('plugins.Toastr', true)

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
                <li><a>Karir</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->

    <!--blog section start-->
    <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
        <div class="container">
            <div class="blogArticlesInner">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="latestNewsCard">
                            <div class="row blogWithSidebarRow">

                                @forelse($careers as $career)
                                    <div class="col-md-12 col-lg-6 blogWithSidebarCol">
                                        <div class="latestNewsCardInner mb-4">
                                            <div class="latestNewsCardInnerContent">
                                                <div class="latestNewsTxt">
                                                    <div class="careerDetailHeading">
                                                        <div class="careerTitle">
                                                            <span class="careerBadge">Lowongan Aktif</span>
                                                            <h3><a href="{{ route('front.career-detail', $career->id) }}">{{ $career->position }}</a></h3>
                                                            <h6>PT. Papandayan Inti Plasma</h6>
                                                        </div>
                                                        <ul class="careerMeta">
                                                            <li>
                                                                <div class="careerMetaLabelRow">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <span>Penempatan</span>
                                                                </div>
                                                                <strong>{{ $career->location }}</strong>
                                                            </li>
                                                            <li>
                                                                <div class="careerMetaLabelRow">
                                                                    <i class="fa fa-calendar"></i>
                                                                    <span>Batas Waktu</span>
                                                                </div>
                                                                <strong>{{ $career->closing_at->locale('id')->isoFormat('D MMMM Y') }}</strong>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="latestNewBtn">
                                                    <a class="btnCustom2 btn-1 hover-slide-down" href="{{ route('front.career-detail', $career->id) }}">
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
                        {{ $careers->links('front.partials.pagination') }}
                    </div>
                    <div class="col-lg-4">
                        <div class="blogSingleAside">
                            @include('front.partials.search-post', [
                                'title' => 'Temukan Karir',
                                'placeholder' => 'Cari posisi',
                                'action' => route('front.career'),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--blog section end-->

@endsection

@push('after-styles')
    <style type="text/css">
        
        /* Modify Career Detail */
        .careerDetailHeading {
            padding: 0px;
            border-radius: 18px;
        }

        .careerTitle {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 18px;
        }

        .careerTitle h3 {
            margin: 0;
            font-weight: 700;
            color: #0f1b49;
        }

        .careerBadge {
            align-self: flex-start;
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background-color: rgba(60, 95, 172, 0.15);
            color: #3c5fac;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .careerMeta {
            list-style: none;
            padding: 0;
            margin: 0 0 24px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .careerMetaLabelRow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .careerMeta li {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 12px 16px;
            border-radius: 12px;
            background-color: rgba(60, 95, 172, 0.05);
            color: #566089;
            font-size: 14px;
        }

        .careerMeta li i {
            color: #3c5fac;
            font-size: 16px;
        }

        .careerMeta li span {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .careerMeta li strong {
            color: #0f1b49;
            font-size: 15px;
        }
    </style>
@endpush

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
