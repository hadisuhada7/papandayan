@extends('front.layouts.app')

@section('title', 'Artikel')

@section('content')

    <!--banner sec start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>Artikel</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Artikel</li>
                </ul>
            </div>
        </div>
    </section>
    <!--banner sec end-->
   
    <!--blog section start-->
    <section class="w-100 clearfix blogArticles blogPg" id="blogArticles">
        <div class="container">
            <div class="blogArticlesInner">
                <div class="row">
                    <div class="col-lg-8">
                        @if(isset($selectedTag) && $selectedTag)
                            <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                                <span>Menampilkan artikel dengan tag: <strong>{{ $selectedTag->name }}</strong></span>
                                <a href="{{ route('front.articles') }}" class="btn btn-sm btn-outline-primary">Tampilkan Semua</a>
                            </div>
                        @endif
                        <div class="latestNewsCard">
                            <div class="row blogWithSidebarRow">

                                @forelse ($articles as $article)
                                    <div class="col-md-12 col-lg-6 blogWithSidebarCol">
                                        <div class="latestNewsCardInner mb-4">
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
                        </div>
                        {{ $articles->links('front.partials.pagination') }}
                    </div>
                    <div class="col-lg-4">
                        <div class="blogSingleAside">
                            @include('front.partials.search-post', [
                                'title' => 'Temukan Artikel',
                                'placeholder' => 'Cari judul artikel',
                                'action' => route('front.articles'),
                            ])

                            <div class="popularTags customCard">
                                <h4>Tag Populer</h4>
                                <div class="tagGroup">
                                    <ul class="nav">

                                        @php
                                            $allTags = \App\Models\Tag::withCount('articles')->orderBy('articles_count', 'desc')->limit(10)->get();
                                        @endphp
                                        @forelse($allTags as $tag)
                                            <li class="nav-item">
                                                <a class="nav-link tag {{ isset($selectedTag) && $selectedTag && $selectedTag->id === $tag->id ? 'tagActive' : '' }}" 
                                                   href="{{ route('front.articles', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a>
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
    <!--blog section end-->

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
