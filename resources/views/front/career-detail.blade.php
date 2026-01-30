@extends('front.layouts.app')

@section('title', 'Career Detail')

@section('content')
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

   <!--header one start-->
   <header class="w-100 clearfix header headerOne" id="headerOne">
      
      <!--top header-->
      <div class="topHeader">
         <div class="container">
            <div class="topHeaderInner">
               <div class="mobile boxGroupHeader">
                  <a href="javascript:void(0);">
                     <div class="flexGroupHeader">
                        <div class="icon">
                           <img src="{{ asset('images/icon/phone.png') }}" alt="icon" class="img-fluid">
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
                           <img src="{{ asset('images/icon/mail.png') }}" alt="icon" class="img-fluid">
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
                        <img src="{{ asset('images/icon/lang.png') }}" alt="icon" class="img-fluid">
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
                     <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#">Our Business</a>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-bs-toggle="dropdown">Sustainability <i
                              class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="#">K3</a></li>
                           <li><a class="dropdown-item" href="#">CSR</a></li>
                           <li><a class="dropdown-item" href="#">Initiatives</a></li>
                           <li><a class="dropdown-item" href="#">Document Reports</a></li>
                        </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-bs-toggle="dropdown">Investor <i
                              class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="#">Annual Reports</a></li>
                           <li><a class="dropdown-item" href="#">Financial Reports</a></li>
                           <li><a class="dropdown-item" href="#">Investor Presentations</a></li>
                           <li><a class="dropdown-item" href="#">Stock and Bond Information</a></li>
                           <li><a class="dropdown-item" href="#">General Meeting of Shareholders</a></li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#">Careers</a>
                     </li>
                  </ul>
               </div>
               <div class="rightMenu">
                  <ul class="nav">
                     <li class="nav-item searchBtn">
                        <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/search.png') }}" alt="loader"
                              class="img-fluid"></a>
                     </li>
                     <li class="nav-item loginBtn d-none d-md-block">
                        <div class="btnGroup">
                           <a class="nav-link btn" href="#">Contact Us</a>
                        </div>
                     </li>
                     <li class="nav-item toggleBtn">
                        <a class="nav-link navbar-toggler" href="javascript:void(0);" data-bs-toggle="collapse"
                           data-bs-target="#collapsibleNavbar">
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
   <!--header one end-->

   <!--search box start-->
   <div class="searchBox searchBox1">
      <div class="container">
         <div class="searchBoxInner">
            <div class="searchHeading">
               <h4>Search Our Site</h4>
            </div>
            <div class="searchInput">
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search">
                  <a href="javascript:void(0);" class="input-group-text searchButton"><span>Search</span> <img
                        src="{{ asset('images/icon/icon-right.png') }}" alt="btn-arrow" class="img-fluid"></a>
               </div>
            </div>
            <div class="quickSearch">
               <p><span>Quick Search:</span>K3, CSR, Initiatives, Document Reports</p>
            </div>
         </div>
      </div>
   </div>
   <!--search box end-->

   <!--banner sec start-->
   <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
      <div class="container">
         <div class="bannerContent">
            <h1>Career Detail</h1>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Career Detail</li>
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
                           <!-- <a href="javascript:void(0);"><img src="{{ asset('images/img38.png') }}" alt="img"
                                 class="w-100 img-fluid"></a>
                           <div class="latestNewsDate">
                              <a href="javascript:void(0);">
                                 <h5>25</h5>
                                 <span>Mar</span>
                              </a>
                           </div> -->
                        </div>
                        <div class="latestNewsCardInnerContent">
                           <!-- <div class="latestNewsList">
                              <div class="latestNewsUser">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/icon/user.png') }}" alt="icon" class="img-fluid"><span>by admin</span>
                                 </a>
                              </div>
                              <div class="latestNewsMessage">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/icon/message.png') }}" alt="icon" class="img-fluid"><span>2
                                       comments</span>
                                 </a>
                              </div>
                           </div> -->
                           <div class="latestNewsTxt">
                              <h4><a href="javascript:void(0);">{{ $career->position }}</a></h4>
                              <p>Penempatan: {{ $career->location }}</p>
                              <p>Batas Waktu: {{ $career->closing_at }}</p>
                           </div>
                           <div class="queryBox">
                              <p>Continually productize compelling quality for packed with Elated productize compelling quality for packed with all Elated Theme Setting up to website and creating pages. Continually productize compelling quality for packed with Elated productize compelling quality for packed with all Elated Theme Setting up to website and creating pages.</p>
                           </div>
                           <p>Proactively unleash parallel outsourcing without equity invested systems.Convenientcocplume mkets For The backward-compatible models. Distinctively transition transparent sources after e-business scricly E-enablese bricks-and-clicks vortals with client-based outsourcing. Professionally drive one-to-oneitures Before worldwid e growth strategie Holisticly envisioneer highly efficient value before.</p>
                        </div>
                        <div class="tagShareGroup">
                           <div class="tagShareGroupInner">
                              <div class="tagGroup">
                                 <ul class="nav">
                                    <li class="nav-item tagHeading">
                                       Tags :
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link tag tagActive" href="javascript:void(0);">Poultry</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link tag" href="javascript:void(0);">Travel</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="shareGroup">
                                 <ul class="nav">
                                    <li class="nav-item shareHeading">
                                       Share :
                                    </li>
                                    <li class="nav-item shareSocialIcon">
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/fb.png') }}" alt="facebook" class="img-fluid"></a>
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/insta.png') }}" alt="instagram" class="img-fluid"></a>
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/twitter.png') }}" alt="twitter" class="img-fluid"></a>
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/whatsapp.png') }}" alt="whatsapp" class="img-fluid"></a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="commentGroup">
                           <div class="commentLeft">
                              <div class="commentUserImg">
                                 <a href="javascript:void(0);">
                                    <img src="{{ asset('images/user1.png') }}" alt="comment-user-img" class="img-fluid">
                                 </a>
                              </div>
                           </div>
                           <div class="commentRight">
                              <div class="commentUserTxt">
                                 <h2>Zahid Jissue</h2>
                                 <p class="mb-0">The backward-compatible models. Distinctively transition transparent sources after e-business scricly E-enablese bricks-and-clicks vortals with client-based outsourcing. </p>
                              </div>
                              <div class="shareGroup">
                                 <ul class="nav">
                                    <li class="nav-item shareSocialIcon">
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/fb.png') }}" alt="facebook" class="img-fluid"></a>
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/insta.png') }}" alt="instagram" class="img-fluid"></a>
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/twitter.png') }}" alt="twitter" class="img-fluid"></a>
                                       <a class="nav-link" href="javascript:void(0);"><img src="{{ asset('images/icon/whatsapp.png') }}" alt="whatsapp" class="img-fluid"></a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="coment">
                           <div class="comentInner">
                              <div class="comentHeading">
                                 <h2>Comments (2)</h2>
                              </div>
                              <div class="comentGroup">
                                 <div class="commentGroup">
                                    <div class="commentLeft">
                                       <div class="commentUserImg">
                                          <a href="javascript:void(0);">
                                             <img src="{{ asset('images/user2.png') }}" alt="comment-user-img" class="img-fluid">
                                          </a>
                                       </div>
                                    </div>
                                    <div class="commentRight">
                                       <div class="commentRightTxt">
                                          <div class="commentUserTxt">
                                             <h2>Vebhav Nayan</h2>
                                             <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.The point of using Lorem Ipsum.</p>
                                          </div>
                                          <div class="dateGroup">
                                             <img src="{{ asset('images/icon/calendar.png') }}" alt="calendar" class="img-fluid"><span>24 July 2023</span>
                                          </div>
                                       </div>
                                       <div class="replyLink">
                                          <a href="javascript:void(0);"><img src="{{ asset('images/icon/shareIcon.png') }}" alt="share-icon" class="img-fluid"> <span>Share</span></a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="commentGroup">
                                    <div class="commentLeft">
                                       <div class="commentUserImg">
                                          <a href="javascript:void(0);">
                                             <img src="{{ asset('images/user3.png') }}" alt="comment-user-img" class="img-fluid">
                                          </a>
                                       </div>
                                    </div>
                                    <div class="commentRight">
                                       <div class="commentRightTxt">
                                          <div class="commentUserTxt">
                                             <h2>Vebhav Nayan</h2>
                                             <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.The point of using Lorem Ipsum.</p>
                                          </div>
                                          <div class="dateGroup">
                                             <img src="{{ asset('images/icon/calendar.png') }}" alt="calendar" class="img-fluid"><span>24 July 2023</span>
                                          </div>
                                       </div>
                                       <div class="replyLink">
                                          <a href="javascript:void(0);"><img src="{{ asset('images/icon/shareIcon.png') }}" alt="share-icon" class="img-fluid"> <span>Share</span></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--comment box-->
                        <div class="commentBox">
                           <div class="commentBoxInner">
                              <div class="commentBoxHeading">
                                 <h4>{{ $career->position }}</h4>
                                 <p>Penempatan: {{ $career->location }}</p>
                                 <p>Batas Waktu: {{ $career->closing_at->format('d F Y') }}</p>
                                 <p>Kualifikasi: {{ strip_tags($career->qualification) }}</p>
                                 <p>Deskripsi Pekerjaan: {{ strip_tags($career->description) }}</p>
                              </div>
                              <div class="commentBoxForm">
                                 <a href="{{ route('front.career-form', $career->id) }}" class="btnCustom5 btn-1 hover-slide-down"><span>Apply <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></a>
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
                           <h4>Search Keyword</h4>
                           <h6>Search</h6>
                           <form>
                              <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search here" value="">
                                 <button type="submit" class="input-group-text"><img src="{{ asset('images/icon/search.png') }}" alt="search" class="img-fluid"></button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="recentPost customCard">
                        <h4>Recent Post</h4>
                        <div class="recentPostList">
                           <div class="recentPostGroupList">
                              <a href="javascript:void(0);">
                                 <div class="recentPostImg">
                                    <img src="{{ asset('images/img40.png') }}" alt="recentPost" class="img-fluid">
                                 </div>
                                 <div class="recentPostTxt">
                                    <p>Seamlessly fashion customiz before.</p>
                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> 8 April 2023</span>
                                 </div>
                              </a>
                           </div>
                           <div class="recentPostGroupList">
                              <a href="javascript:void(0);">
                                 <div class="recentPostImg">
                                    <img src="{{ asset('images/img41.png') }}" alt="recentPost" class="img-fluid">
                                 </div>
                                 <div class="recentPostTxt">
                                    <p>Know the Benefit Of Boiled Egg</p>
                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> 9 April 2023</span>
                                 </div>
                              </a>
                           </div>
                           <div class="recentPostGroupList">
                              <a href="javascript:void(0);">
                                 <div class="recentPostImg">
                                    <img src="{{ asset('images/img42.png') }}" alt="recentPost" class="img-fluid">
                                 </div>
                                 <div class="recentPostTxt">
                                    <p>Seamlessly fashion customiz before.</p>
                                    <span><img src="{{ asset('images/icon/calendar.png') }}" alt="whatsapp" class="img-fluid"> 10 April 2023</span>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="popularTags customCard">
                        <h4>Popular Tags</h4>
                        <div class="tagGroup">
                           <ul class="nav">
                              <li class="nav-item">
                                 <a class="nav-link tag tagActive" href="javascript:void(0);">Poultry</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Travel</a>
                              </li>  
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Breeder</a>
                              </li>    
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Feed</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link tag" href="javascript:void(0);">Chicks</a>
                              </li>
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

   <!--footer start-->
   <footer class="w-100 clearfix footer footerBg1" id="footer">
      <div class="needOurSupport">
         <div class="container">
            <div class="needOurSupportInner">
               <div class="needOurSupportTxt">
                  <h2 class="fadein">Still You Need Our Support</h2>
                  <p class="fadein">There are many variations of passages of lorem ipsum available but the majority have
                     suffered
                     alteration in some form by injected humor.</p>
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
                              <img src="{{ asset('images/logo/logo-footer-2.png') }}" alt="footer-logo" class="img-fluid">
                           </div>
                           <div class="footerPara fadein">
                              <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                 suffered alteration in some form.</p>
                           </div>
                           <hr class="hrLine fadein">
                           <div class="socialMediaIcon fadein">
                              <ul class="nav">
                                 <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-whatsapp"
                                          aria-hidden="true"></i></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-instagram"
                                          aria-hidden="true"></i></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-facebook"
                                          aria-hidden="true"></i></a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-twitter"
                                          aria-hidden="true"></i></a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="footerCol footerCol2">
                           <div class="footerMenuHeading">
                              <h4 class="fadein">Useful Links</h4>
                           </div>
                           <div class="footerMenuLink">
                              <ul class="nav flex-column">
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="about-us.html"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> About Us</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="poultry-feed.html"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Poultry Feeds </a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="our-service.html"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Our Services</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="gallery-2-column.html"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Gallery</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="video-gallery.html"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Videos</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="footerCol footerCol3">
                           <div class="footerMenuHeading">
                              <h4 class="fadein">Our Services</h4>
                           </div>
                           <div class="footerMenuLink">
                              <ul class="nav flex-column">
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Breeders</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Our Blogs</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> FAQ</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Policy</a>
                                 </li>
                                 <li class="nav-item fadein">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-caret-right"
                                          aria-hidden="true"></i> Terms & Condition</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-lg-3">
                        <div class="footerCol footerCol4">
                           <div class="footerMenuHeading">
                              <h4 class="fadein">Contact Information</h4>
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
                                             <h6>Call Us Now:</h6>
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
                                             <h6>Email Address:</h6>
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
                                             <h6>Office Hour:</h6>
                                             <p class="mb-0">08:00 - 18:00</p>
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
                  <p class="mb-0 fadein">Copyright © 2023 <a href="javascript:void(0);">Farmland</a>. All Rights
                     Reserved.</p>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!--footer end-->
@endsection

@push('after-scripts')
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

   <script>
      $(document).ready(function ($) {
         
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