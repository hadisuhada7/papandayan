@extends('front.layouts.app')

@section('title', 'Inisiatif Detail')

@section('content')

    <!--banner sec start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>Inisiatif Detail</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Inisiatif Detail</li>
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
                                <div class="latestNewsCardImg">
                                    <a href="javascript:void(0);"><img src="{{ Storage::url($initiative->thumbnail) }}" alt="img" class="w-100 img-fluid"></a>
                                    <div class="latestNewsDate">
                                        <a href="javascript:void(0);">
                                            <h5>{{ $initiative->publish_at->format('d') }}</h5>
                                            <span>{{ $initiative->publish_at->format('M') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="latestNewsCardInnerContent">
                                    <div class="latestNewsList">
                                        <div class="latestNewsUser">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-user" style="color: #3c5fac;"></i><span>{{ $initiative->author }}</span>
                                            </a>
                                        </div>
                                        <div class="latestNewsUser">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-eye" style="color: #3c5fac;"></i><span>{{ $initiative->viewer }} Viewers</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="latestNewsTxt">
                                        <h4><a href="javascript:void(0);">{{ $initiative->title }}</a></h4>
                                        <div>{!! $initiative->about !!}</div>
                                    </div>
                                    <!-- <div class="queryBox">
                                        <p>Sample</p>
                                    </div> -->
                                </div>
                                <div class="tagShareGroup">
                                    <div class="tagShareGroupInner">
                                        <div class="shareGroup">
                                            <ul class="nav">
                                                <li class="nav-item shareHeading">
                                                    Share :
                                                </li>
                                                <li class="nav-item shareSocialIcon">
                                                    <a class="nav-link" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/fb.png') }}" alt="facebook" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/insta.png') }}" alt="instagram" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($initiative->title) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/twitter.png') }}" alt="twitter" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://api.whatsapp.com/send?text={{ urlencode($initiative->title . ' - ' . request()->url()) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/whatsapp.png') }}" alt="whatsapp" class="img-fluid"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="commentBox">
                                    <div class="commentBoxInner">
                                        <div class="commentBoxHeading">
                                            <h4>Berikan Tanggapan</h4>
                                            <p>Alamat email Anda tidak akan dipublikasikan. Kolom yang wajib diisi ditandai dengan <span style="color: red">*</span></p>
                                        </div>
                                        <div class="commentBoxForm">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <input type="text" class="form-control" id="fullName" placeholder="Nama Lengkap" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="commentFormGroup">
                                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="commentFormGroup">
                                                            <input type="text" class="form-control" id="website" placeholder="Website" name="website">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="commentFormGroup">
                                                            <textarea class="form-control" rows="5" id="writeComment" placeholder="Tulis Komentar"  name="comment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btnCustom2 btn-1 hover-slide-down"><span>Kirim <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></button>
                                            </form>
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
                                <h4>Temukan Artikel</h4>
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
                                
                                    @forelse($recentInitiatives as $recentInitiative)
                                    <div class="recentPostGroupList">
                                        <a href="{{ route('front.initiative-detail', $recentInitiative->id) }}">
                                            <div class="recentPostImg">
                                                <img src="{{ Storage::url($recentInitiative->thumbnail) }}" alt="recentPost" class="img-fluid">
                                            </div>
                                            <div class="recentPostTxt">
                                                <p>{{ $recentInitiative->title }}</p>
                                                <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> {{ $recentInitiative->created_at->format('d F Y') }} </span>
                                            </div>
                                        </a>
                                    </div>
                                    @empty
                                        <p class="text-muted mb-0">Belum ada artikel terbaru</p>
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