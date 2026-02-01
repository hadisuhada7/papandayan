@extends('front.layouts.app')

@section('title', 'Pencarian')

@push('before-styles')
    <style>
        .searchHero {
            background: radial-gradient(circle at top, rgba(60, 95, 172, 0.95), #1d2746);
            padding: 90px 0 70px;
            color: #ffffff;
            position: relative;
        }
        .searchHeroContent h1,
        .searchHeroContent p {
            color: #ffffff;
        }
        .searchHero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset('images/inner-banner.png') }}') center/cover no-repeat;
            opacity: 0.15;
        }
        .searchHero .container {
            position: relative;
            z-index: 2;
        }
        .searchResultsWrap {
            padding: 60px 0 90px;
            background: #f7f8fc;
        }
        .searchFormPanel {
            background: #ffffff;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(12, 21, 47, 0.08);
            margin-top: -80px;
            position: relative;
            z-index: 3;
        }
        .searchFormPanel .input-group {
            border: 1px solid rgba(60, 95, 172, 0.3);
            border-radius: 12px;
            overflow: hidden;
        }
        .searchFormPanel .form-control {
            border: none;
            padding: 16px 20px;
            font-size: 1rem;
        }
        .searchFormPanel .form-control:focus {
            box-shadow: none;
        }
        .searchFormPanel .btnSearchAction {
            background: var(--accent-color, #3c5fac);
            color: #fff;
            border: none;
            padding: 0 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
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
        }
        .searchSummary {
            margin: 50px 0 30px;
        }
        .searchSummary p {
            margin: 0;
            color: #6c758b;
            font-size: 1rem;
        }
        .searchSection {
            margin-bottom: 40px;
        }
        .searchSectionHeader {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }
        .searchSectionHeader h3 {
            margin: 0;
            font-size: 1.5rem;
            color: #1d2746;
        }
        .searchSectionHeader span {
            color: #7b85a1;
            font-size: 0.95rem;
        }
        .searchCards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }
        .searchCard {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 14px 30px rgba(12, 21, 47, 0.07);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .searchCardMeta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }
        .searchCardMeta .badge {
            background: rgba(60, 95, 172, 0.15);
            color: #3c5fac;
            border-radius: 999px;
            padding: 5px 14px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .searchCardMeta .meta {
            font-size: 0.85rem;
            color: #8a94b5;
        }
        .searchCard h4 {
            font-size: 1.15rem;
            margin-bottom: 10px;
        }
        .searchCard h4 a {
            color: #1d2746;
            text-decoration: none;
        }
        .searchCard p {
            color: #6c758b;
            font-size: 0.95rem;
            flex: 1;
        }
        .searchCard .btnCustom5 {
            align-self: flex-start;
            margin-top: 16px;
        }
        .searchEmptyState {
            background: #fff;
            border-radius: 18px;
            padding: 40px;
            text-align: center;
            color: #7b85a1;
            box-shadow: 0 14px 35px rgba(12, 21, 47, 0.08);
            margin-top: 30px;
        }
        @media (max-width: 767px) {
            .searchFormPanel {
                padding: 20px;
                margin-top: -60px;
            }
            .searchCards {
                grid-template-columns: 1fr;
            }
            .searchSectionHeader {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="w-100 clearfix searchHero" id="searchHero">
        <div class="container">
            <div class="searchHeroContent">
                <p class="mb-2 text-uppercase" style="letter-spacing: 4px; opacity: 0.8;">Papandayan Inti Plasma</p>
                <h1 class="mb-3">Telusuri Informasi Terbaru</h1>
                <p class="mb-0">Cari artikel, program CSR, inisiatif strategis, serta dokumen penting perusahaan dalam satu tempat.</p>
            </div>
        </div>
    </section>

    <section class="w-100 clearfix searchResultsWrap" id="searchResultsWrap">
        <div class="container">
            <div class="searchFormPanel">
                <form action="{{ route('front.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="{{ $query }}" placeholder="Cari artikel, CSR, inisiatif, atau dokumen" aria-label="Masukkan kata kunci pencarian" required>
                        <button type="submit" class="btnSearchAction">Cari</button>
                    </div>
                </form>
                @if(!empty($quickSearchTerms))
                    <div class="searchChips">
                        <span>Quick Search:</span>
                        @foreach($quickSearchTerms as $term)
                            @php $queryValue = $term['query'] ?? $term['label']; @endphp
                            <a href="{{ route('front.search', ['q' => $queryValue]) }}">{{ $term['label'] }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(!$hasSearched)
                <div class="searchEmptyState">
                    Masukkan kata kunci untuk mulai mencari informasi yang Anda butuhkan.
                </div>
            @else
                <div class="searchSummary">
                    <p>Menampilkan <strong>{{ $totalCount }}</strong> hasil untuk <strong>&ldquo;{{ $query }}&rdquo;</strong>.</p>
                </div>

                @if($totalCount === 0)
                    <div class="searchEmptyState">
                        <p class="mb-2">Maaf, kami tidak menemukan hasil yang relevan.</p>
                        <p class="mb-0">Coba gunakan kata kunci lain atau pilih salah satu opsi Quick Search.</p>
                    </div>
                @endif

                @foreach($results as $section)
                    @if($section['items']->isNotEmpty())
                        <div class="searchSection">
                            <div class="searchSectionHeader">
                                <h3>{{ $section['label'] }}</h3>
                                <span>{{ $section['items']->count() }} hasil</span>
                            </div>
                            <div class="searchCards">
                                @foreach($section['items'] as $item)
                                    <div class="searchCard">
                                        <div class="searchCardMeta">
                                            <span class="badge">{{ $item['badge'] ?? $section['label'] }}</span>
                                            @if(!empty($item['meta']))
                                                <span class="meta">{{ $item['meta'] }}</span>
                                            @endif
                                        </div>
                                        <h4><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></h4>
                                        @if(!empty($item['excerpt']))
                                            <p>{{ $item['excerpt'] }}</p>
                                        @endif
                                        <a class="btnCustom5 btn-1 hover-slide-down" href="{{ $item['url'] }}">
                                            <span>Selengkapnya <img src="{{ asset('images/icon/icon-right.png') }}" alt="right" class="img-fluid"></span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </section>
@endsection

@push('after-scripts')
    <script>
        const header = document.querySelector('.headerOne');
        const toggleClass = 'headerActive';
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 150) {
                header.classList.add(toggleClass);
            } else {
                header.classList.remove(toggleClass);
            }
        });
    </script>
@endpush
