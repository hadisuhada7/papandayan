<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - Papandayan Inti Plasma</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('before-styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/grt-youtube-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fancybox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/jquery-timeline/css/timeline.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/leaflet/dist/leaflet.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/favicon.png') }}">

    <style>
        :root {
            --accent-color: #3c5fac;
        }

        .scroll-top {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 15px;
            bottom: -15px;
            z-index: 99999;
            background-color: var(--accent-color, #3c5fac);
            width: 44px;
            height: 44px;
            border-radius: 50px;
            transition: all 0.4s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
        }

        .scroll-top.active {
            visibility: visible;
            opacity: 1;
            bottom: 15px;
        }

        .scroll-top i {
            font-size: 15px;
            color: #fff;
            line-height: 0;
        }

        .scroll-top:hover {
            background-color: #2e3192;
            color: #fff;
        }

        
      .breadcrumb {
         margin: 0 0 40px;
         padding: 20px 0;
         border-radius: 8px;
      }
      
      .breadcrumb ul {
         list-style: none;
         padding: 0;
         margin: 0;
         display: flex;
         align-items: center;
         justify-content: center;
         flex-wrap: wrap;
      }
      
      .breadcrumb ul li {
         display: inline-flex;
         align-items: center;
         position: relative;
         padding: 0 10px;
      }
      
      .breadcrumb ul li:not(:last-child)::after {
         content: '›';
         position: absolute;
         right: -5px;
         color: #3c5fac;
         font-size: 20px;
         font-weight: bold;
      }
      
      .breadcrumb ul li a {
         color: #3c5fac;
         text-decoration: none;
         font-weight: 500;
         transition: all 0.3s ease;
         padding: 8px 12px;
         border-radius: 5px;
         display: inline-block;
      }

      .breadcrumb ul li:last-child a {
         color: #6c757d;
         font-weight: 500;
         cursor: default;
         pointer-events: none;
      }
      
      @media (max-width: 768px) {
         .breadcrumb ul {
            justify-content: flex-start;
            padding-left: 15px;
         }
         
         .breadcrumb ul li {
            padding: 0 10px;
         }
         
         .breadcrumb ul li:not(:last-child)::after {
            right: -3px;
            font-size: 18px;
         }
      }
   
    </style>

    @stack('after-styles')

</head>

<body>

    <!--preloader start-->
    <div id="preloader">
        <div id="status">
            <div class="u-loading">
                <div class="u-loading__symbol">
                    <img src="{{ asset('images/logo/logo2.png') }}" alt="loader" class="img-fluid">
                </div>
            </div>
            <div class="loader" id="dotsLoader">
               <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!--preloader end-->

    <!--header start-->
    <header class="w-100 clearfix header headerOne" id="headerOne">

        <!--top header-->
        <div class="topHeader">
            <div class="container">
                <div class="topHeaderInner">
                    <div class="mobile boxGroupHeader">
                        <a href="https://api.whatsapp.com/send/?phone=6281400561146&text=Halo%2C+saya+mau+tanya+seputar+Papandayan%2C+mohon+informasinya&2C+terima+kasih&type=phone_number&app_absent=0">
                            <div class="flexGroupHeader">
                                <div class="icon">
                                    <i class="fa fa-phone" style="color: white;"></i>
                                </div>
                                <div class="iconTxt">
                                    <span>(+62) 81400561146</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="mail boxGroupHeader">
                        <a href="javascript:void(0);">
                            <div class="flexGroupHeader">
                                <div class="icon">
                                    <i class="fa fa-envelope" style="color: white;"></i>
                                </div>
                                <div class="iconTxt">
                                    <span>kontak@papandayan.co.id</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="language boxGroupHeader ms-auto">
                        <div class="flexGroupHeader">
                            <div class="icon">
                                <i class="fa fa-language" style="color: white;"></i>
                            </div>
                            <div class="iconTxt">
                                <select class="form-select">
                                    <option>EN</option>
                                    <option>ID</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--main header-->
        <div class="mainHeader">
            <nav class="navbar navbar-expand-xl">
                <div class="container">
                    <a class="navbar-brand" href="#"><img src="{{ asset('images/logo/logo1.png') }}" alt="loader" class="img-fluid"></a>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            @php
                                // Gabungkan uncategorized menus dan groups, lalu urutkan berdasarkan order
                                $allMenuItems = collect();
                                
                                // Tambahkan uncategorized menus
                                foreach($uncategorizedMenus as $menu) {
                                    $allMenuItems->push([
                                        'type' => 'uncategorized',
                                        'order' => $menu->order,
                                        'data' => $menu
                                    ]);
                                }
                                
                                // Tambahkan group menus
                                foreach($menuGroups as $group) {
                                    if($group->menu_navigations->count() > 0) {
                                        $allMenuItems->push([
                                            'type' => 'group',
                                            'order' => $group->order,
                                            'data' => $group
                                        ]);
                                    }
                                }
                                
                                // Urutkan berdasarkan order
                                $allMenuItems = $allMenuItems->sortBy('order');
                            @endphp

                            {{-- Render menu sesuai urutan dari database --}}
                            @foreach($allMenuItems as $menuItem)
                                @if($menuItem['type'] === 'uncategorized')
                                    @php $menu = $menuItem['data']; @endphp
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ $menu->url ?: '#' }}">
                                            @if($menu->icon)
                                                <i class="{{ $menu->icon }}"></i>
                                            @endif
                                            {{ $menu->name }}
                                        </a>
                                    </li>
                                @elseif($menuItem['type'] === 'group')
                                    @php $group = $menuItem['data']; @endphp
                                    @if($group->menu_navigations->count() == 1)
                                        {{-- Jika hanya ada 1 menu dalam grup, tampilkan sebagai menu biasa --}}
                                        @php $singleMenu = $group->menu_navigations->first(); @endphp
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $singleMenu->url ?: '#' }}">
                                                @if($singleMenu->icon)
                                                    <i class="{{ $singleMenu->icon }}"></i>
                                                @endif
                                                {{ $singleMenu->name }}
                                            </a>
                                        </li>
                                    @else
                                        {{-- Jika ada lebih dari 1 menu dalam grup, tampilkan sebagai dropdown --}}
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="#" data-bs-toggle="dropdown">
                                                {{ $group->name }}
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach($group->menu_navigations as $menu)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ $menu->url ?: '#' }}">
                                                            @if($menu->icon)
                                                                <i class="{{ $menu->icon }}"></i>
                                                            @endif
                                                            {{ $menu->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="rightMenu">
                        <ul class="nav">
                            <li class="nav-item searchBtn">
                                <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/search.png') }}" alt="loader" class="img-fluid"></a>
                            </li>
                            <li class="nav-item loginBtn d-none d-md-block">
                                <div class="btnGroup">
                                    <a class="nav-link btn" href="{{ route('front.contact') }}">Hubungi Kami</a>
                                </div>
                            </li>
                            <li class="nav-item toggleBtn">
                                <a class="nav-link navbar-toggler" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                                    <span class="navbar-toggler-icon"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!--overlay-->
        <div class="widgetOverlay"></div>

    </header>
    <!--header end-->

    <!--search box start-->
    <div class="searchBox searchBox1">
        <div class="container">
            <div class="searchBoxInner">
                <div class="searchHeading">
                    <h4>Cari di Situs Kami</h4>
                </div>
                <div class="searchInput">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <a href="javascript:void(0);" class="input-group-text searchButton"><span>Search</span>
                            <img src="{{ asset('images/icon/icon-right.png') }}" alt="btn-arrow" class="img-fluid"></a>
                    </div>
                </div>
                <div class="quickSearch">
                    <p><span>Quick Search:</span>K3, CSR, Inisiatif, Laporan Dokumen</p>
                </div>
            </div>
        </div>
    </div>
    <!--search box end-->

    @yield('content-header')

    @yield('content')

    @yield('content-footer')

    <!--footer start-->
    <footer class="w-100 clearfix footer footerBg1" id="footer">
        <div class="needOurSupport">
            <div class="container">
                <div class="needOurSupportInner">
                    <div class="needOurSupportTxt">
                        <h2 class="fadein">Still You Need Our Support</h2>
                        <p class="fadein">There are many variations of passages of lorem ipsum available but the majority have
                            suffered alteration in some form by injected humor.</p>
                    </div>
                    <div class="needOurSupportInput">
                        <div class="input-group fadein">
                            <input type="text" class="form-control" placeholder="Email Address">
                            <a href="javascript:void(0);" class="input-group-text subscriptionBtn"><span>Subscription</span>
                                <img src="{{ asset('images/icon/icon-right.png') }}" alt="btn-arrow" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerGroup">
            <div class="footerInner">
                <div class="container">
                    <div class="footerInnerRow">
                        <div class="row">
                            <div class="col-md-12 col-lg-3">
                                <div class="footerCol footerCol1">
                                    <div class="footerLogo fadein">
                                        <img src="{{ asset('images/logo/logo-footer.png') }}" alt="footer-logo" class="img-fluid">
                                    </div>
                                    <div class="footerPara fadein">
                                        <p>Sukses Bersama Peternak</p>
                                        <br>
                                        <p>
                                            Apartemen Permata Eksekutif Tower 1, Kantor Lt.2 <br>
                                            Jl.Pos Pengumben RT.1 / RW.6 Kebon Jeruk, Jakarta Barat
                                        </p>
                                    </div>
                                    <hr class="hrLine fadein">
                                    <div class="socialMediaIcon fadein">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://api.whatsapp.com/send/?phone=6281400561146&text=Halo%2C+saya+mau+tanya+seputar+Papandayan%2C+mohon+informasinya&2C+terima+kasih&type=phone_number&app_absent=0"><i class="fa fa-whatsapp"
                                                    aria-hidden="true"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://www.instagram.com/papandayanintiplasma"><i class="fa fa-instagram"
                                                    aria-hidden="true"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="http://www.linkedin.com/in/pt-papandayan-inti-plasma-318256301;"><i class="fa fa-linkedin"
                                                    aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="footerCol footerCol2">
                                    <div class="footerMenuHeading">
                                        <h4 class="fadein">Official Site Map</h4>
                                    </div>
                                    <div class="footerMenuLink">
                                        <ul class="nav flex-column">
                                            @php
                                                // Gabungkan uncategorized menus dan groups, lalu urutkan berdasarkan order (sama seperti nav)
                                                $allFooterMenuItems = collect();
                                                
                                                // Tambahkan uncategorized menus
                                                foreach($uncategorizedMenus as $menu) {
                                                    $allFooterMenuItems->push([
                                                        'type' => 'uncategorized',
                                                        'order' => $menu->order,
                                                        'data' => $menu
                                                    ]);
                                                }
                                                
                                                // Tambahkan group menus
                                                foreach($menuGroups as $group) {
                                                    if($group->menu_navigations->count() > 0) {
                                                        $allFooterMenuItems->push([
                                                            'type' => 'group',
                                                            'order' => $group->order,
                                                            'data' => $group
                                                        ]);
                                                    }
                                                }
                                                
                                                // Urutkan berdasarkan order
                                                $allFooterMenuItems = $allFooterMenuItems->sortBy('order');
                                            @endphp

                                            @foreach($allFooterMenuItems as $menuItem)
                                                @if($menuItem['type'] === 'uncategorized')
                                                    @php $menu = $menuItem['data']; @endphp
                                                    <li class="nav-item fadein">
                                                        <a class="nav-link" href="{{ $menu->url ?: '#' }}">
                                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                            {{ $menu->name }}
                                                        </a>
                                                    </li>
                                                @elseif($menuItem['type'] === 'group')
                                                    @php $group = $menuItem['data']; @endphp
                                                    <li class="nav-item fadein">
                                                        <a class="nav-link" href="#">
                                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                            {{ $group->name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="footerCol footerCol3">
                                    @php
                                        // Ambil grup pertama yang memiliki menu atau default ke "Tentang Kami"
                                        $firstGroupWithMenus = $menuGroups->first(function($group) {
                                            return $group->menu_navigations->count() > 0;
                                        });
                                        $groupTitle = $firstGroupWithMenus ? $firstGroupWithMenus->name : 'Tentang Kami';
                                    @endphp
                                    <div class="footerMenuHeading">
                                        <h4 class="fadein">{{ $groupTitle }}</h4>
                                    </div>
                                    <div class="footerMenuLink">
                                        <ul class="nav flex-column">
                                            @if($firstGroupWithMenus)
                                                @foreach($firstGroupWithMenus->menu_navigations as $menu)
                                                    <li class="nav-item fadein">
                                                        <a class="nav-link" href="{{ $menu->url ?: 'javascript:void(0);' }}">
                                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                            {{ $menu->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                {{-- Fallback jika tidak ada menu --}}
                                                <li class="nav-item fadein">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Profile Perusahaan
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="footerCol footerCol4">
                                    <div class="footerMenuHeading">
                                        <h4 class="fadein">Informasi Kontak</h4>
                                    </div>
                                    <div class="footerMenuLink footerContactInfo">
                                        <ul class="nav flex-column">
                                            <li class="nav-item fadein">
                                                <a class="nav-link" href="javascript:void(0);">
                                                <div class="contactInfo">
                                                    <div class="contactInfoIcon">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="contactInfoTxt">
                                                        <h6>Hubungi Kami:</h6>
                                                        <p class="mb-0">(+62) 81400561146</p>
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                            <li class="nav-item fadein">
                                                <a class="nav-link" href="javascript:void(0);">
                                                <div class="contactInfo">
                                                    <div class="contactInfoIcon">
                                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="contactInfoTxt">
                                                        <h6>Alamat Email:</h6>
                                                        <p class="mb-0">kontak@papandayan.co.id</p>
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                            <li class="nav-item fadein">
                                                <a class="nav-link" href="javascript:void(0);">
                                                <div class="contactInfo">
                                                    <div class="contactInfoIcon">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="contactInfoTxt">
                                                        <h6>Jam Operasional:</h6>
                                                        <p class="mb-0">08:00 - 17:00 WIB</p>
                                                    </div>
                                                </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerCopyRight">
                <div class="container">
                    <div class="footerCopyRightInner">
                        <p class="mb-0 fadein">Copyright © 2026 <a href="javascript:void(0);">Papandayan Inti Plasma</a>. All Rights
                            Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer end-->

    <a href="#" id="scroll-top" class="scroll-top"><i class="fa fa-arrow-up"></i></a>
    
    @stack('before-scripts')
    
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/contact_form.js') }}"></script>
    <script src="{{ asset('js/grt-youtube-popup.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/jquery-timeline/js/timeline.min.js') }}"></script>
    <script src="{{ asset('vendor/leaflet/dist/leaflet.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

    <script>
        // Scroll to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#scroll-top').addClass('active');
            } else {
                $('#scroll-top').removeClass('active');
            }
        });

        $('#scroll-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 600);
            return false;
        });
    </script>

    @stack('after-scripts')

</body>
</html>