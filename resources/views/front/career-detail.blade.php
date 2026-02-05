@extends('front.layouts.app')

@section('title', 'Karir Detail')

@section('content')

    <!--banner sec start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>Karir Detail</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Karir Detail</li>
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
                                <div class="commentBox no-top-gap">
                                    <div class="commentBoxInner">
                                        <div class="careerDetailHeading">
                                            <div class="careerTitle">
                                                <span class="careerBadge">Lowongan Aktif</span>
                                                <h3>{{ $career->position }}</h3>
                                                <h6>PT. Papandayan Inti Plasma</h6>
                                            </div>
                                            <ul class="careerMeta">
                                                <li>
                                                    <div class="careerMetaLabelRow">
                                                        <i class="fa fa-user"></i>
                                                        <span>Pengalaman Kerja</span>
                                                    </div>
                                                    <strong>{{ $career->work_experience }}</strong>
                                                </li>
                                                <li>
                                                    <div class="careerMetaLabelRow">
                                                        <i class="fa fa-briefcase"></i>
                                                        <span>Tipe Pekerjaan</span>
                                                    </div>
                                                    <strong>{{ $career->work_type }}</strong>
                                                </li>
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
                                            <div class="careerInfoGrid">
                                                <div class="careerInfoBlock">
                                                    <h6><i class="fa fa-user" aria-hidden="true"></i> Kualifikasi</h6>
                                                    <div class="careerRichText">{!! $career->qualification !!}</div>
                                                </div>
                                                <div class="careerInfoBlock">
                                                    <h6><i class="fa fa-briefcase" aria-hidden="true"></i> Deskripsi Pekerjaan</h6>
                                                    <div class="careerRichText">{!! $career->description !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="commentBoxForm">
                                            <a href="{{ route('front.career-form', $career->id) }}" class="btnCustom2 btn-1 hover-slide-down"><span>Apply <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blogSingleAside">
                            <div class="searchKeyword customCard">
                                <div class="searchKeywordInner">
                                <h4>Temukan Pekerjaan</h4>
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" value="">
                                            <button type="submit" class="input-group-text"><img src="{{ asset('images/icon/search.png') }}" alt="search" class="img-fluid"></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="recentPost customCard">
                                <h4>Postingan Terbaru</h4>
                                <div class="recentPostList">

                                    @forelse($recentCareers as $recentCareer)
                                        <div class="recentPostGroupList">
                                            <a href="{{ route('front.career-detail', $recentCareer->id) }}">
                                                <div class="recentPostImg recentPostIcon">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                </div>
                                                <div class="recentPostTxt">
                                                    <p>{{ $recentCareer->position }}</p>
                                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="calendar" class="img-fluid"> {{ $recentCareer->posting_at->locale('id')->isoFormat('D MMMM Y') }} </span>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <p class="text-muted mb-0">Belum ada karir terbaru</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--blog single end-->

@endsection

@push('after-styles')
    <style type="text/css">

        /* Remove top gap when needed */
        .blogSingle .blogSingleInner .blogSingleBlog .latestNewsCardInner .commentBox.no-top-gap {
            margin-top: 0;
        }

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
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 12px;
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

        .careerInfoGrid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .careerInfoBlock h6 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #3c5fac;
            margin-bottom: 12px;
        }

        .careerInfoBlock h6 i {
            margin-right: 6px;
        }

        .careerRichText {
            color: #4c4f5f;
            line-height: 1.7;
        }

        .careerRichText ul,
        .careerRichText ol {
            padding-left: 18px;
            margin-bottom: 0;
        }

        /* Modify Recent Post Icon */
        .recentPostIcon {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(60, 95, 172, 0.05);
            color: #566089;
            border-radius: 12px;
            min-height: 80px;
        }

        .recentPostIcon i {
            color: #3c5fac;
            font-size: 28px;
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