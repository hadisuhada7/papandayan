@extends('adminlte::page')

@section('title', 'Papandayan | Ticket Detail')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Ticket Detail</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Ticket Information</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Ticket Number</dt>
                        <dd class="col-sm-8">{{ $ticket->ticket_number }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">{{ ucfirst($ticket->status->value ?? $ticket->status) }}</dd>

                        <dt class="col-sm-4">Priority</dt>
                        <dd class="col-sm-8">{{ ucfirst($ticket->priority) }}</dd>

                        <dt class="col-sm-4">Channel</dt>
                        <dd class="col-sm-8">{{ ucfirst($ticket->channel) }}</dd>

                        <dt class="col-sm-4">Created</dt>
                        <dd class="col-sm-8">{{ $ticket->created_at?->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-4">Requester</dt>
                        <dd class="col-sm-8">
                            <div>{{ $ticket->requester_name }}</div>
                            <small class="text-muted">{{ $ticket->requester_email }}</small>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Message</h3>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">{{ $ticket->subject }}</h5>
                    <p class="mb-0" style="white-space: pre-line;">{{ $ticket->message }}</p>
                </div>
            </div>

            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Admin Response</h3>
                </div>
                <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="new" @selected(old('status', $ticket->status->value ?? $ticket->status) === 'new')>New</option>
                                <option value="open" @selected(old('status', $ticket->status->value ?? $ticket->status) === 'open')>Open</option>
                                <option value="responded" @selected(old('status', $ticket->status->value ?? $ticket->status) === 'responded')>Responded</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="response_message">Response Message</label>
                            <textarea class="form-control" id="response_message" name="response_message" rows="5">{{ old('response_message', $ticket->response_message) }}</textarea>
                        </div>
                        <input type="hidden" name="question_id" value="{{ $ticket->question_id }}">
                        <input type="hidden" name="subject" value="{{ $ticket->subject }}">
                        <input type="hidden" name="message" value="{{ $ticket->message }}">
                        <input type="hidden" name="requester_name" value="{{ $ticket->requester_name }}">
                        <input type="hidden" name="requester_email" value="{{ $ticket->requester_email }}">
                        <input type="hidden" name="requester_phone" value="{{ $ticket->requester_phone }}">
                        <input type="hidden" name="priority" value="{{ $ticket->priority }}">
                        <input type="hidden" name="channel" value="{{ $ticket->channel }}">
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="submit" class="btn btn-success">Submit Response</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('partials.toastr')
@stop