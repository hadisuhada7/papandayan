@extends('front.layouts.app')

@section('title', 'Subscription')

@section('content')

    <!--breadcrumb start-->
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{ route('front.index') }}">Beranda</a></li>
                <li><a>Subscription</a></li>
            </ul>
        </div>
    </div>
    <!--breadcrumb end-->

    <!--all article start-->
    <section class="w-100 clearfix blogArticles blogPg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card p-4">
                        <h3 class="mb-3">{{ $title }}</h3>
                        <p class="mb-4">{{ $message }}</p>
                        @if (!empty($actionUrl))
                            <a href="{{ $actionUrl }}" class="btn btn-primary">{{ $actionLabel }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--all article end-->
    
@endsection

@push('after-styles')
    <style>
        .card {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }
    </style>
@endpush
