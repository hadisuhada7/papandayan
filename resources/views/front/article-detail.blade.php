@extends('front.layouts.app')

@section('title', 'Article Detail')

@section('content')

   <!--banner sec start-->
   <section class="w-100 clearfix bannerSec" id="bannerSec" style="background-image: url('{{ asset('images/inner-banner.png') }}');">
      <div class="container">
         <div class="bannerContent">
            <h1>Article Detail</h1>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Beranda</a></li>
               <li class="breadcrumb-item active">Article Detail</li>
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
                           <a href="javascript:void(0);"><img src="{{ asset('images/img38.png') }}" alt="img"
                                 class="w-100 img-fluid"></a>
                           <div class="latestNewsDate">
                              <a href="javascript:void(0);">
                                 <h5>25</h5>
                                 <span>Mar</span>
                              </a>
                           </div>
                        </div>
                        <div class="latestNewsCardInnerContent">
                           <div class="latestNewsList">
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
                           </div>
                           <div class="latestNewsTxt">
                              <h4><a href="javascript:void(0);">Omega-3 chicken, egg may lower heart attack</a></h4>
                              <p>Give lady of they such they sure it. Me contained explained my education. Vulgar as hearts by garret. Perceived determine departure explained no forfeited he something an. Contrasted dissimilar get joy you instrument out reasonably. Again keeps at no meant stuff. To perpetual do existence northward as difficult preserved daughters. Continued at up to zealously necessary breakfast. Surrounded sir motionless she end literature. Gay direction neglected but supported yet her.</p>
                              <p>New had happen unable uneasy. Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.</p>
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
                                 <h4>Leave Comment</h4>
                                 <p>Your email address will not be published. Required fields are marked *</p>
                              </div>
                              <div class="commentBoxForm">
                                 <form>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div class="commentFormGroup">
                                             <input type="text" class="form-control" id="yourName" placeholder="Your Name" name="name">
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
                                             <textarea class="form-control" rows="5" id="writeComment" placeholder="Write a Comment"  name="comment"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btnCustom5 btn-1 hover-slide-down"><span>Send <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span></button>
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
@endsection

@push('after-scripts')
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