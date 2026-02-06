@extends('front.layouts.app')

@section('title', 'Tentang Kami')

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
                <li><a>Tentang Kami</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->
   
	<!--about us sec1 start-->
	<section class="w-100 clearfix aboutUsSec1" id="aboutUsSec1">
		<div class="container">

			@forelse($profiles as $profile)
				<div class="row aboutUsRow1">
					<div class="col-xl-6 aboutUsCol1">
						<div class="aboutUsSec1Img">
							<img src="{{ Storage::url($profile->thumbnail) }}" alt="" class="img-fluid">
						</div>  
					</div>  
					<div class="col-xl-6 aboutUsCol1">
						<div class="aboutUsSec1Content">
							<div class="aboutUsSec1Para">
								<h5 class="fadein visible" style="color: #3c5fac;">Tentang Kami</h5>
								<h4 class="fadein visible">{{ $profile->name }}</h4>
								<p>{!! $profile->description !!}</p>
							</div> 
							<!-- <div class="aboutUsSec1Counter">
								<div class="aboutUsSec1Row" id="counter-stats">
									<div class="aboutUsSec1Col">
										<h5 class="mb-0"><span class="counting" data-count="21">0</span> +</h5>
										<span>Our Team</span>
									</div>
									<div class="aboutUsSec1Col">
										<h5 class="mb-0"><span class="counting" data-count="85">0</span> +</h5>
										<span>Our Shop</span>
									</div>
									<div class="aboutUsSec1Col">
										<h5 class="mb-0"><span class="counting" data-count="99">0</span> +</h5>
										<span>Our Brand</span>
									</div>
								</div>
							</div> -->
						</div> 
					</div>   
				</div>
			@empty
			@endforelse

		</div>
	</section>
	<!--about us sec1 end-->

	<!--broiler breeder start-->
	@php
		$visionThumbnail = optional($visions->first())->thumbnail;
		$missionThumbnail = optional($missions->first())->thumbnail;
	@endphp
	<section class="w-100 clearfix broilerBreeder" id="broilerBreeder">
		<div class="broilerBreederInner">
			<div class="pigFactsTopics">
				<div class="pigFactsTopicsRow">
					<div class="pigFactsTopicsCol pigFactsTopicsCol1 order-xl-1">
						<div class="pigFactsTxt layerBreeders">
							<div class="pigFactsTxtInner">

								@forelse ($visions as $vision)
									<div class="broilerBreederContent">
										<div class="broilerBreederHeadGroup">
											<div class="broilBreederImg">
												<img src="{{ Storage::url($vision->icon) }}" alt="Broiler-Breeder" class="img-fluid">
											</div>
											<div class="broilBreederHeading">
												<h2 class="mb-0">{{ $vision->name }}</h2>
											</div>
										</div>
										<div class="broilerBreederPara">
											<p>{{ $vision->description }}</p>

											@if($vision->keypoints && count($vision->keypoints) > 0)
												<ul>
													@foreach ($vision->keypoints as $keypoint)
														@if(!empty($keypoint->keypoint))
														<li>{{ $keypoint->keypoint }}</li>
														@endif
													@endforeach
												</ul>
											@endif

										</div>
									</div>
								@empty
								@endforelse

							</div>
						</div>
					</div>
					<div class="pigFactsTopicsCol pigFactsTopicsCol2 order-xl-2">
						<div class="pigFactsTxt broilerBreeders">
							<div class="pigFactsTxtInner">

								@forelse ($missions as $mission)
									<div class="broilerBreederContent">
										<div class="broilerBreederHeadGroup">
											<div class="broilBreederImg">
												<img src="{{ Storage::url($mission->icon) }}" alt="Broiler-Breeder" class="img-fluid">
											</div>
											<div class="broilBreederHeading">
												<h2 class="mb-0">{{ $mission->name }}</h2>
											</div>
										</div>
										<div class="broilerBreederPara">
											<p>{{ $mission->description }}</p>

											@if($mission->keypoints && count($mission->keypoints) > 0)
												<ul>
													@foreach ($mission->keypoints as $keypoint)
														@if(!empty($keypoint->keypoint))
														<li>{{ $keypoint->keypoint }}</li>
														@endif
													@endforeach
												</ul>
											@endif
											
										</div>
									</div>
								@empty
								@endforelse

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--broiler breeder end-->

	<!--poultry feed start-->
	<section class="w-100 clearfix poultryFeed" id="poultryFeed">
		<div class="commonHeading text-center">
			<h4 class="fadein">Jejak Langkah</h4>
			<p class="fadein">Rangkuman perjalanan dan perkembangan Papandayan Inti Plasma dari tahun ke tahun</p>
		</div>
		<div class="container">
			<div class="poultryFeedInner">
				<div class="poultryFeedBanner">
					<div class="timeline">
						<div class="timeline__wrap">
							<div class="timeline__items">

								@forelse ($histories as $history)
									<div class="timeline__item">
										<div class="timeline__content">
											<h2 style="color: #3c5fac;">{{ $history->track_record_at->locale('id')->isoFormat('D MMMM Y') }}</h2>
											<p>{{ $history->description }}</p>
										</div>
									</div>
								@empty
								@endforelse

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--poultry feed end-->

	<!--poultry feed start-->
	<section class="w-100 clearfix poultryFeed" id="poultryFeed">
		<div class="commonHeading text-center">
			<h4 class="fadein">Struktur Organisasi</h4>
			<p class="fadein">Susunan peran dan tanggung jawab dalam perusahaan</p>
		</div>
		<div class="container">
			<div class="poultryFeedInner">

				@forelse ($organizations as $organization)
					<div class="poultryFeedBanner">
						<img src="{{ Storage::url($organization->thumbnail) }}" alt="poultry-feed" class="w-100 img-fluid">
					</div>
				@empty
				@endforelse

			</div>
		</div>
	</section>
	<!--poultry feed end-->

	<!--team four wrapper start-->
	<div class="team-four-wrapper padd-100 w-100 team-bg">
		<div class="commonHeading text-center">
			<h4 class="fadein">Manajemen Kami</h4>
			<p class="fadein">Tim Manajemen Papandayan Inti Plasma</p>
		</div>
		<div class="container shoCustomContainer">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="team-four-wrapper">
						<div class="owl-carousel owl-theme">
							
							@forelse ($managements as $management)
								<div class="item">
									<div class="four-content">
										<div class="team-four-img">
											<img src="{{ Storage::url($management->avatar) }}" alt="img">
										</div>
										<div class="team-four-content w-100">
											<h6>{{ $management->name }}</h6>
											<span>{{ $management->occupation }}</span>
											<div class="social-icon-four">
												@if($management->facebook)
													<a href="{{ $management->facebook }}">
														<i class="fab fa-facebook-f"></i>
													</a>
												@endif
												@if($management->instagram)
													<a href="{{ $management->instagram }}">
														<i class="fab fa-instagram"></i>
													</a>
												@endif
												@if($management->twitter)
													<a href="{{ $management->twitter }}">
														<i class="fab fa-twitter"></i>
													</a>
												@endif
												@if($management->linkedin)
													<a href="{{ $management->linkedin }}">
														<i class="fab fa-linkedin-in"></i>
													</a>
												@endif
											</div>
										</div>
									</div>
								</div>
							@empty
							@endforelse

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--team four wrapper end-->

   	<!--maps section start-->
    <section class="w-100 clearfix mapsSection" id="mapsSection">
        <div class="commonHeading text-center">
            <h4 class="fadein">Wilayah Persebaran</h4>
            <p class="fadein">Papandayan Inti Plasma beroperasi di berbagai wilayah Jawa Barat dengan komitmen membangun kemitraan budidaya ayam broiler yang berkelanjutan</p>
        </div>
        <div class="container">
            <div class="mapsSectionInner fadein">
                <div class="mapOverlay">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
    <!--maps section end-->

@endsection

@push('after-styles')
	@if($visionThumbnail || $missionThumbnail)
		<style>
			@if($visionThumbnail)
			.broilerBreeder .pigFactsTopics .pigFactsTopicsRow .pigFactsTopicsCol1 .pigFactsTxt.layerBreeders::before {
				background-image: url('{{ Storage::url($visionThumbnail) }}');
			}
			@endif
			@if($missionThumbnail)
			.broilerBreeder .pigFactsTopics .pigFactsTopicsRow .pigFactsTopicsCol2 .pigFactsTxt.broilerBreeders::before {
				background-image: url('{{ Storage::url($missionThumbnail) }}');
			}
			@endif
		</style>
	@endif
@endpush

@push('after-scripts')
	<script>
		$(document).ready(function ($) {

			// Number count for stats, using jQuery animate 
			$('.counting').each(function() {
				var $this = $(this),
				countTo = $this.attr('data-count');
				$({ countNum: $this.text()}).animate({
					countNum: countTo
				},
				{
					duration: 3000,
					easing:'linear',
					step: function() {
						$this.text(Math.floor(this.countNum));
					},
					complete: function() {
						$this.text(this.countNum);
						// alert('finished');
					}
				});  
			});

			// Add any page-specific JavaScript here
			timeline(document.querySelectorAll('.timeline'), {
				forceVerticalMode: 700,
				mode: 'horizontal',
				verticalStartPosition: 'left',
				visibleItems: 4
			});

			// Team four wrapper carousel
			$('.team-four-wrapper .owl-carousel').owlCarousel({
				loop: true,
				margin: 10,
				nav: false,
				dots: true,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 2
					},
					1000: {
						items: 3
					}
				}
			});
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

		// Initialize Leaflet Maps
        var map = L.map('map').setView([-6.9175, 107.6191], 10); // Center on Bandung, West Java

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Add coverage area markers
        @if(isset($coverageAreas) && count($coverageAreas) > 0)
            @foreach($coverageAreas as $area)
                @if($area->latitude && $area->longitude)
                    L.marker([{{ $area->latitude }}, {{ $area->longitude }}]).addTo(map)
                    .bindPopup('<b>{{ $area->partner_name }}</b><br/>Jumlah Kandang: {{ $area->number_of_cages }}');
                @endif
            @endforeach
        @endif

	</script>
@endpush