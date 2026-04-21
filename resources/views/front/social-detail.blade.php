@extends('front.layouts.app')

@section('title', 'CSR Detail')

@section('content')

    <!--banner start-->
    <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
        <div class="container">
            <div class="bannerContent">
                <h1>CSR Detail</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.socials') }}">CSR</a></li>
                    <li class="breadcrumb-item active">CSR Detail</li>
                </ul>
            </div>
        </div>
    </section>
    <!--banner end-->
   
    <!--article single start-->
    <section class="w-100 clearfix blogSingle" id="blogSingle">
        <div class="container">
            <div class="blogSingleInner">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blogSingleBlog">
                            <div class="latestNewsCardInner">
                                <div class="latestNewsCardImg">
                                    <a href="javascript:void(0);"><img src="{{ Storage::url($social->thumbnail) }}" alt="img" class="w-100 img-fluid"></a>
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
                                        <h4><a href="javascript:void(0);">{{ $social->title }}</a></h4>
                                        <div>{!! $social->about !!}</div>
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
                                                    <a class="nav-link" href="javascript:void(0);" onclick="copyArticleLink()" title="Copy Link"><img src="{{ asset('images/icon/insta.png') }}" alt="copy link" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://x.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($social->title) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/twitter.png') }}" alt="twitter" class="img-fluid"></a>
                                                    <a class="nav-link" href="https://api.whatsapp.com/send?text={{ urlencode($social->title . ' - ' . request()->url()) }}" target="_blank" rel="noopener noreferrer"><img src="{{ asset('images/icon/whatsapp.png') }}" alt="whatsapp" class="img-fluid"></a>
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
                                                <button type="button" class="btnCustom2 btn-1 hover-slide-down"><span>Kirim <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></button>
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

                                    @forelse($recentSocials as $recentSocial)
                                        <div class="recentPostGroupList">
                                            <a href="{{ route('front.social-detail', $recentSocial->slug) }}">
                                                <div class="recentPostImg">
                                                    <img src="{{ Storage::url($recentSocial->thumbnail) }}" alt="recentPost" class="img-fluid">
                                                </div>
                                                <div class="recentPostTxt">
                                                    <p>{{ $recentSocial->title }}</p>
                                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> {{ $recentSocial->publish_at->locale('id')->isoFormat('D MMMM Y') }} </span>
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

        // Copy article link to clipboard
        function copyArticleLink() {
            const url = window.location.href;
            
            // Modern clipboard API
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(() => {
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Link artikel berhasil disalin! Anda bisa paste di Instagram Story.');
                    }
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                    fallbackCopyTextToClipboard(url);
                });
            } else {
                // Fallback for older browsers
                fallbackCopyTextToClipboard(url);
            }
        }

        // Fallback copy method for older browsers
        function fallbackCopyTextToClipboard(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.top = 0;
            textArea.style.left = 0;
            textArea.style.width = "2em";
            textArea.style.height = "2em";
            textArea.style.padding = 0;
            textArea.style.border = "none";
            textArea.style.outline = "none";
            textArea.style.boxShadow = "none";
            textArea.style.background = "transparent";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Link artikel berhasil disalin! Anda bisa paste di Instagram Story.');
                    }
                } else {
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Gagal menyalin link. Silakan copy manual.');
                    }
                }
            } catch (err) {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Gagal menyalin link. Silakan copy manual.');
                }
            }
            
            document.body.removeChild(textArea);
        }
    </script>
@endpush
