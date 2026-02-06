@php
    $title = $title ?? 'Temukan Post';
    $placeholder = $placeholder ?? 'Cari judul';
    $action = $action ?? url()->current();
    $value = request()->query('q', '');
@endphp

<div class="searchKeyword customCard mb-4">
    <div class="searchKeywordInner">
        <h4>{{ $title }}</h4>
        <form method="GET" action="{{ $action }}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{ $placeholder }}" name="q" value="{{ $value }}">
                <button type="submit" class="input-group-text">
                    <img src="{{ asset('images/icon/search.png') }}" alt="search" class="img-fluid">
                </button>
            </div>
        </form>
    </div>
</div>
