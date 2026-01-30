@extends('adminlte::page')

@section('title', 'Papandayan | Dashboard')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Dashboard</h3>
                </div>
                <div class="card-body">
                    <p>Welcome to Papandayan CMS</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- add stylesheets --}}
@stop

@section('js')
    {{-- add scripts --}}
@stop