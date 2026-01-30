@extends('adminlte::page')

@section('title', 'Papandayan | Email Log Detail')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Email Log Detail</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.email-logs.index') }}">Email Logs</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Log Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Recipient</dt>
                        <dd class="col-sm-8">{{ $log->recipient_email }}</dd>

                        <dt class="col-sm-4">Subject</dt>
                        <dd class="col-sm-8">{{ $log->subject }}</dd>

                        <dt class="col-sm-4">Template</dt>
                        <dd class="col-sm-8">{{ $log->template }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ ucfirst($log->status) }}</dd>

                        <dt class="col-sm-4">Sent At</dt>
                        <dd class="col-sm-8">{{ $log->sent_at?->format('d M Y H:i') ?? '-' }}</dd>

                        <dt class="col-sm-4">Ticket</dt>
                        <dd class="col-sm-8">{{ $log->ticket?->ticket_number ?? '-' }}</dd>

                        <dt class="col-sm-4">Question</dt>
                        <dd class="col-sm-8">{{ $log->question?->id ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">Error Message</h3>
                </div>
                <div class="card-body">
                    <p class="mb-0" style="white-space: pre-line;">{{ $log->error_message ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('partials.toastr')
@stop