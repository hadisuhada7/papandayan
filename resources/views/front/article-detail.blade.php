@extends('front.layouts.app')

@section('title', 'Artikel Detail')

@section('content')

    <!--banner sec start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>Artikel Detail</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Artikel Detail</li>
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
                                <a href="javascript:void(0);"><img src="{{ Storage::url($article->thumbnail) }}" alt="img" class="w-100 img-fluid"></a>
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
                                        <h4><a href="javascript:void(0);">{{ $article->title }}</a></h4>
                                        <div>{!! $article->about !!}</div>
                                    </div>
                                    <!-- <div class="queryBox">
                                        <p>Sample</p>
                                    </div> -->
                                </div>
                                <div class="tagShareGroup">
                                    <div class="tagShareGroupInner">
                                        <div class="tagGroup">
                                            <ul class="nav">

                                                @if($article->tags->count() > 0)
                                                    <li class="nav-item tagHeading">
                                                        Tags :
                                                    </li>
                                                    @foreach($article->tags as $tag)
                                                        <li class="nav-item">
                                                            <a class="nav-link tag" href="javascript:void(0);">{{ $tag->name }}</a>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </div>
                                        <div class="shareGroup">
                                            <ul class="nav">
                                                <li class="nav-item shareHeading">
                                                    Share :
                                                </li>
                                                <li class="nav-item shareSocialIcon">
                                                    <a class="nav-link" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/fb.png') }}" alt="facebook" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/insta.png') }}" alt="instagram" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/twitter.png') }}" alt="twitter" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . request()->url()) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/whatsapp.png') }}" alt="whatsapp" class="img-fluid"></a>
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
                            <div class="recentPost customCard">
                                <h4>Postingan Terbaru</h4>
                                <div class="recentPostList">

                                    @forelse($recentArticles as $recentArticle)
                                        <div class="recentPostGroupList">
                                            <a href="{{ route('front.article-detail', $recentArticle->id) }}">
                                                <div class="recentPostImg">
                                                    <img src="{{ Storage::url($recentArticle->thumbnail) }}" alt="recentPost" class="img-fluid">
                                                </div>
                                                <div class="recentPostTxt">
                                                    <p>{{ $recentArticle->title }}</p>
                                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> {{ $recentArticle->publish_at->locale('id')->isoFormat('D MMMM Y') }} </span>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <p class="text-muted mb-0">Belum ada artikel terbaru</p>
                                    @endforelse

                                </div>
                            </div>
                            <div class="popularTags customCard">
                                <h4>Tag Populer</h4>
                                <div class="tagGroup">
                                    <ul class="nav">

                                        @php
                                            $allTags = \App\Models\Tag::withCount('articles')->orderBy('articles_count', 'desc')->limit(10)->get();
                                        @endphp
                                        @forelse($allTags as $tag)
                                            <li class="nav-item">
                                                <a class="nav-link tag" href="javascript:void(0);">{{ $tag->name }}</a>
                                            </li>
                                        @empty
                                            <li class="nav-item">
                                                <span class="text-muted">Tidak ada tag tersedia</span>
                                            </li>
                                        @endforelse

                                    </ul>
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
