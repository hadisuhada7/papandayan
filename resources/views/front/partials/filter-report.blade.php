@php
    $yearOptions = $yearOptions ?? [];
    $selectedYearValue = isset($selectedYear) && $selectedYear ? (string) $selectedYear : 'all';
    $selectedSortValue = $selectedSort ?? 'desc';
@endphp

<section class="w-100 clearfix reportFilter" id="reportFilter">
    <div class="container">
        <div class="reportFilterInner">
            <form class="report-filter-form" method="GET" action="{{ url()->current() }}">
                @foreach (request()->except(['year', 'sort', 'page']) as $key => $value)
                    @if (is_array($value))
                        @foreach ($value as $item)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <div class="report-filter-controls">
                    <div class="report-filter-group">
                        <label for="filter-year">Tahun</label>
                        <select name="year" id="filter-year" class="form-control">
                            <option value="all" @selected($selectedYearValue === 'all')>Semua</option>
                            @foreach ($yearOptions as $year)
                                <option value="{{ $year }}" @selected($selectedYearValue === (string) $year)>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="report-filter-group">
                        <label for="filter-sort">Urutan</label>
                        <select name="sort" id="filter-sort" class="form-control">
                            <option value="desc" @selected($selectedSortValue === 'desc')>Terbaru</option>
                            <option value="asc" @selected($selectedSortValue === 'asc')>Terlama</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@push('after-styles')
    <style>
        .reportFilter {
            padding: 10px 0 0;
        }
        .reportFilterInner {
            display: flex;
            justify-content: flex-end;
        }
        .report-filter-controls {
            display: flex;
            align-items: flex-end;
            gap: 20px;
            flex-wrap: wrap;
        }
        .report-filter-group {
            min-width: 180px;
        }
        .report-filter-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .report-filter-group .form-control {
            border-radius: 6px;
            height: 44px;
            padding: 0.45rem 0.9rem;
        }

        @media (max-width: 767px) {
            .reportFilterInner {
                justify-content: flex-start;
            }
            .report-filter-controls {
                width: 100%;
            }
            .report-filter-group {
                flex: 1 1 200px;
            }
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.report-filter-form select').forEach(function (select) {
                select.addEventListener('change', function () {
                    if (this.form) {
                        this.form.submit();
                    }
                });
            });
        });
    </script>
@endpush
