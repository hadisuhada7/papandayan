@extends('adminlte::page')

@section('title', 'Papandayan | Partner Detail')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Partner Detail for {{ $partner->full_name }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
                <li class="breadcrumb-item active">{{ $partner->full_name }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Partner Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Full Name:</strong>
                            <p>{{ $partner->full_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Email:</strong>
                            <p>{{ $partner->email }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                            <p>{{ $partner->phone_number }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Company Name:</strong>
                            <p>{{ $partner->company_name }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Address:</strong>
                            <p>{{ $partner->address }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Created At:</strong>
                            <p>{{ $partner->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Partner Company Description</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align: justify;">{{ $partner->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- add stylesheets --}}
@stop

@section('js')
    @include('partials.toastr')
@stop
