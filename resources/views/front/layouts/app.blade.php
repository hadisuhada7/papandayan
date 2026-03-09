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
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/favicon.png') }}">

    <style type="text/css">
        :root {
            --accent-color: #2e3192;
        }

        /* Modify Scroll Top Button */
        .scroll-top {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 15px;
            bottom: -15px;
            z-index: 99999;
            background-color: var(--accent-color, #2e3192);
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
            background-color: #3c5fac;
            color: #fff;
        }

        .footerPara.officeInfo {
            color: #fff;
        }

        /* Modify Footer Office Info */
        .footerPara.officeInfo .officeHeading {
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
            text-transform: uppercase;
        }

        .footerPara.officeInfo .officeInfoRow {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .footerPara.officeInfo .officeInfoRow:last-child {
            margin-bottom: 0;
        }

        .footerPara.officeInfo .officeInfoIcon {
            font-size: 18px;
        }

        /* Search Chips Styling */
        .searchChips {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .searchChips span {
            font-weight: 600;
            color: #1d2746;
            margin-right: 6px;
        }

        .searchChips a {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            background: rgba(60, 95, 172, 0.12);
            color: #3c5fac;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .searchChips a:hover {
            background: rgba(60, 95, 172, 0.2);
            transform: translateY(-1px);
            line-height: 1.4;
        }

        .footerPara.officeInfo .officeInfoText p {
            margin-bottom: 6px;
            line-height: 1.5;
        }

        .footerPara.officeInfo .officeInfoText p:last-child {
            margin-bottom: 0;
        }

        .footerPara.officeInfo .officeInfoText span {
            color: #a0a0a0;
        }

        /* Scroll to Top & WhatsApp Floating Buttons */
        #scroll-top,
        #whatsapp-float {
            position: fixed;
            right: 1.8rem;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
        }

        /* Scroll to top - positioned on top */
        #scroll-top {
            bottom: 5.3rem;
        }

        #scroll-top.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* WhatsApp button - positioned below scroll-top */
        #whatsapp-float {
            bottom: 1.8rem;
            background: #25D366;
            color: #fff;
            font-size: 26px;
        }

        #whatsapp-float.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        #whatsapp-float:hover {
            background: #128C7E;
            transform: translateY(0);
            box-shadow: 2px 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Modify Breadcrumb */
        .breadcrumb {
            border-radius: 8px;
            margin-top: 1rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
      
        .breadcrumb ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
            min-width: fit-content;
        }
      
        .breadcrumb ul li {
            display: inline-flex;
            align-items: center;
            position: relative;
            padding: 0 10px;
            white-space: nowrap;
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
      
        /* Tablet Responsive */
        @media (max-width: 992px) {
            .breadcrumb ul li a {
                padding: 6px 10px;
                font-size: 0.95rem;
            }
            
            .breadcrumb ul li:not(:last-child)::after {
                font-size: 18px;
            }

            /* #scroll-top,
            #whatsapp-float {
                right: 18px;
                width: 42px;
                height: 42px;
            }

            #scroll-top {
                bottom: 75px;
            }

            #whatsapp-float {
                bottom: 18px;
                font-size: 24px;
            } */
        }
      
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .breadcrumb {
                margin-top: 0.5rem;
                border-radius: 0;
            }
            
            .breadcrumb ul {
                justify-content: flex-start;
                padding: 8px 0;
                flex-wrap: nowrap;
                overflow-x: auto;
            }
            
            .breadcrumb ul li {
                padding: 0 8px;
            }
            
            .breadcrumb ul li a {
                padding: 6px 8px;
                font-size: 0.875rem;
            }
            
            .breadcrumb ul li:not(:last-child)::after {
                right: -2px;
                font-size: 16px;
            }

            /* #scroll-top,
            #whatsapp-float {
                right: 2rem;
                width: 40px;
                height: 40px;
            }

            #scroll-top {
                bottom: 70px;
            }

            #whatsapp-float {
                bottom: 15px;
                font-size: 22px;
            } */
        }
      
        /* Small Mobile Responsive */
        @media (max-width: 480px) {
            .breadcrumb ul li {
                padding: 0 5px;
            }
            
            .breadcrumb ul li a {
                padding: 5px 6px;
                font-size: 0.8rem;
            }
            
            .breadcrumb ul li:not(:last-child)::after {
                font-size: 14px;
                right: -1px;
            }

            /* #scroll-top,
            #whatsapp-float {
                right: 12px;
                width: 38px;
                height: 38px;
            }

            #scroll-top {
                bottom: 65px;
            }

            #whatsapp-float {
                bottom: 12px;
                font-size: 20px;
            } */
        }

        /* Modify Dropdown Labels Wrap on Mobile */
        @media (max-width: 1199px) {
            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown {
                position: static;
            }

            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown .dropdown-menu {
                position: static;
                transform: none !important;
                width: 100%;
                min-width: 0;
                margin-top: 8px;
                padding: 12px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            }

            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown .dropdown-menu .dropdown-item {
                white-space: normal;
                line-height: 1.4;
                padding: 10px 14px;
            }
        }

        /* Fix dropdown positioning to prevent jitter on desktop */
        @media (min-width: 1200px) {
            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown {
                position: relative;
            }

            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                margin-top: 0 !important;  /* Remove gap between menu and submenu */
                display: none;
                z-index: 1000;
            }

            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown.show .dropdown-menu {
                display: block;
            }

            /* Extend hover area to prevent gap issues */
            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 2px;  /* Small bridge to prevent hover gap */
                background: transparent;
            }

            /* Smooth dropdown transition */
            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown .dropdown-menu {
                transition: opacity 0.2s ease;
            }

            /* Cursor pointer for dropdown links */
            .mainHeader .navbar .container #collapsibleNavbar .navbar-nav li.dropdown > a {
                cursor: pointer;
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
                    <img src="{{ asset('images/logo/loader.png') }}" alt="loader" class="img-fluid">
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
                        <a href="https://api.whatsapp.com/send/?phone=6281400561146&text=Halo%2C+saya+mau+tanya+seputar+Papandayan%2C+mohon+informasinya&2C+terima+kasih&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer">
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
                        <a href="mailto:kontak@papandayan.co.id">
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
                                    <option>ID</option>
                                    <option>EN</option>
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
                    <a class="navbar-brand" href="{{ route('front.index') }}"><img src="{{ asset('images/logo/logo-header.png') }}" alt="logo-header" class="img-fluid"></a>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">

                            @php
                                $allMenuItems = collect();
                                
                                foreach($uncategorizedMenus as $menu) {
                                    $allMenuItems->push([
                                        'type' => 'uncategorized',
                                        'order' => $menu->order,
                                        'data' => $menu
                                    ]);
                                }
                                
                                foreach($menuGroups as $group) {
                                    if($group->menu_navigations->count() > 0) {
                                        $allMenuItems->push([
                                            'type' => 'group',
                                            'order' => $group->order,
                                            'data' => $group
                                        ]);
                                    }
                                }
                                
                                $allMenuItems = $allMenuItems->sortBy('order');
                            @endphp

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
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle-custom" href="#" role="button">
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
                                <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/search.png') }}" alt="search" class="img-fluid"></a>
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
                    <form action="{{ route('front.search') }}" method="GET" class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search" aria-label="Cari Konten">
                            <button type="submit" class="input-group-text searchButton">
                                <span>Search</span>
                                <img src="{{ asset('images/icon/icon-right.png') }}" alt="btn-arrow" class="img-fluid">
                            </button>
                        </div>
                    </form>
                </div>
                <div class="searchChips">
                    @php
                        $quickSearchTerms = config('papandayan.search.quick_terms', []);
                    @endphp

                    <span>Quick Search:</span>

                    @if(!empty($quickSearchTerms))
                        @foreach($quickSearchTerms as $term)
                            @php $queryValue = $term['query'] ?? $term['label']; @endphp
                            <a href="{{ route('front.search', ['q' => $queryValue]) }}">{{ $term['label'] }}</a>
                        @endforeach
                    @endif
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
                        <h2>Info Investasi & Laporan Berkala</h2>
                        <p>Jangan lewatkan update kinerja perusahaan. Jadilah yang pertama menerima laporan kuartalan dan tahunan kami langsung di kotak masuk Anda.</p>
                    </div>
                    <div class="needOurSupportInput">
                        <div class="input-group">
                            <input type="email" class="form-control" id="subscription-email" name="subscription_email" maxlength="50" placeholder="Email Address" aria-label="Email Address">
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
                                    <div class="footerLogo">
                                        <img src="{{ asset('images/logo/logo-footer.png') }}" alt="logo-footer" class="img-fluid">
                                    </div>
                                    <div class="footerPara officeInfo">
                                        <div class="officeHeading">Kantor Pusat</div>
                                        <div class="officeInfoRow">
                                            <div class="officeInfoIcon">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </div>
                                            <div class="officeInfoText">
                                                <p style="font-weight: bold;">PT. Papandayan Inti Plasma</p>
                                                <p>Apartemen Permata Eksekutif Lt. 2</p>
                                                <p>Jl. Pos Pengumben RT.01 / RW.06 </p>
                                                <p>Kebon Jeruk, Jakarta Barat</p>
                                            </div>
                                        </div>
                                        <div class="officeInfoRow">
                                            <div class="officeInfoIcon">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </div>
                                            <div class="officeInfoText">
                                                <p>(+62) 81400561146</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hrLine">
                                    <div class="socialMediaIcon">
                                        <ul class="nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://maps.app.goo.gl/oUpVnLnRh27anmai6" target="_blank" rel="noopener noreferrer"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://api.whatsapp.com/send/?phone=6281400561146&text=Halo%2C+saya+mau+tanya+seputar+Papandayan%2C+mohon+informasinya&2C+terima+kasih&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://www.instagram.com/papandayanintiplasma" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="http://www.linkedin.com/in/pt-papandayan-inti-plasma-318256301" target="_blank" rel="noopener noreferrer"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="footerCol footerCol2">

                                    @php
                                        $firstGroupWithMenus = $menuGroups->first(function($group) {
                                            return $group->menu_navigations->count() > 0;
                                        });

                                        $groupTitle = $firstGroupWithMenus ? $firstGroupWithMenus->name : 'Tentang Kami';
                                    @endphp

                                    <div class="footerMenuHeading">
                                        <h4>{{ $groupTitle }}</h4>
                                    </div>
                                    <div class="footerMenuLink">
                                        <ul class="nav flex-column">

                                            @if($firstGroupWithMenus)
                                                @foreach($firstGroupWithMenus->menu_navigations as $menu)
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ $menu->url ?: 'javascript:void(0);' }}">
                                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                            {{ $menu->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Profile Perusahaan
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Visi & Misi
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Jejak Langkah
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Struktur Organisasi
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Manajemen Kami
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Area Jangkauan
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="footerCol footerCol3">

                                    @php
                                        $secondGroupWithMenus = $menuGroups->skip(1)->first(function($group) {
                                            return $group->menu_navigations->count() > 0;
                                        });

                                        $groupTitleSustainability = $secondGroupWithMenus ? $secondGroupWithMenus->name : 'Keberlanjutan';
                                    @endphp

                                    <div class="footerMenuHeading">
                                        <h4>{{ $groupTitleSustainability }}</h4>
                                    </div>
                                    <div class="footerMenuLink">
                                        <ul class="nav flex-column">

                                            @if($secondGroupWithMenus)
                                                @foreach($secondGroupWithMenus->menu_navigations as $menu)
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ $menu->url ?: 'javascript:void(0);' }}">
                                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                            {{ $menu->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        K3
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        CSR
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Inisiatif
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);">
                                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                        Laporan Dokumen
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
                                        <h4>Informasi Kontak</h4>
                                    </div>
                                    <div class="footerMenuLink footerContactInfo">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="https://api.whatsapp.com/send/?phone=6281400561146&text=Halo%2C+saya+mau+tanya+seputar+Papandayan%2C+mohon+informasinya&2C+terima+kasih&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer">
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
                                            <li class="nav-item">
                                                <a class="nav-link" href="mailto:kontak@papandayan.co.id">
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
                                            <li class="nav-item">
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
                        <p class="mb-0">Copyright © 2026 <a href="{{ route('front.index') }}">Papandayan Inti Plasma</a>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer end-->

    <!--scroll to top start-->
    <a href="#" id="scroll-top" class="scroll-top"><i class="fa fa-arrow-up"></i></a>
    <!--scroll to top end-->

    <!--whatsapp floating button start-->
    <a href="https://api.whatsapp.com/send/?phone=6281400561146&text=Halo%2C+saya+mau+tanya+seputar+Papandayan%2C+mohon+informasinya%2C+terima+kasih&type=phone_number&app_absent=0" 
       id="whatsapp-float" 
       class="whatsapp-float" 
       target="_blank" 
       rel="noopener noreferrer">
        <i class="fa fa-whatsapp"></i>
    </a>
    <!--whatsapp floating button end-->
    
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
    <script src="{{ asset('js/custom.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('vendor/jquery-timeline/js/timeline.min.js') }}"></script>
    <script src="{{ asset('vendor/leaflet/dist/leaflet.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        // Activate WhatsApp floating button
        $('#whatsapp-float').addClass('active');

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

        // Copy email text into the clipboard with a gracefull fallback
        $(document).on('click', '.copy-to-clipboard', function(e) {
            e.preventDefault();
            var copyText = $(this).data('copy-text');

            if (!copyText) {
                return;
            }

            var notify = function() {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Alamat email berhasil disalin.');
                }
            };

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(copyText)
                    .then(notify)
                    .catch(function() {
                        fallbackCopy(copyText, notify);
                    });
            } else {
                fallbackCopy(copyText, notify);
            }
        });

        function fallbackCopy(text, callback) {
            var tempInput = $('<input type="text" readonly>');
            $('body').append(tempInput);
            tempInput.val(text).select();

            try {
                document.execCommand('copy');
                if (typeof callback === 'function') {
                    callback();
                }
            } finally {
                tempInput.remove();
            }
        }

        // Subscription form handler
        (function () {
            var $emailInput = $('#subscription-email');
            var $button = $('.subscriptionBtn');
            var isSubmitting = false;

            // Email validation function
            var isValidEmail = function (email) {
                return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
            };

            var showToast = function (type, message) {
                if (typeof toastr !== 'undefined') {
                    toastr[type](message);
                }
            };

            var setLoading = function (loading) {
                isSubmitting = loading;
                $button.toggleClass('disabled', loading);
                $button.css('pointer-events', loading ? 'none' : 'auto');
            };

            var submitSubscription = function () {
                if (isSubmitting) {
                    return;
                }

                var email = ($emailInput.val() || '').trim();

                if (!email) {
                    showToast('error', 'Email harus diisi.');
                    return;
                }

                if (!isValidEmail(email)) {
                    showToast('error', 'Gunakan format email yang valid dengan domain lengkap (contoh: nama@domain.com).');
                    return;
                }

                setLoading(true);

                $.ajax({
                    url: "{{ route('front.subscription.store') }}",
                    method: "POST",
                    data: {
                        email: email,
                        _token: $('meta[name=\"csrf-token\"]').attr('content')
                    }
                }).done(function (response) {
                    showToast('success', response.message || 'Berhasil berlangganan.');
                    $emailInput.val('');
                }).fail(function (xhr) {
                    var message = 'Gagal berlangganan.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    showToast('error', message);
                }).always(function () {
                    setLoading(false);
                });
            };

            $(document).on('click', '.subscriptionBtn', function (e) {
                e.preventDefault();
                submitSubscription();
            });

            $emailInput.on('keypress', function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                    submitSubscription();
                }
            });
        })();
    </script>

    @include('partials.toastr')

    @stack('after-scripts')

</body>
</html>
