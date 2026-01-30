@extends('adminlte::page')

@section('title', 'Papandayan | Edit Ticket')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Ticket</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Form Ticket</h3>
                </div>
                <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ticket Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $ticket->ticket_number }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="question_id" class="col-sm-3 col-form-label">Linked Question</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="question_id" name="question_id">
                                            <option value="">-- Optional --</option>
                                            @foreach ($questions as $question)
                                                <option value="{{ $question->id }}" @selected(old('question_id', $ticket->question_id) == $question->id)>
                                                    {{ $question->name }} - {{ $question->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-sm-3 col-form-label">Subject <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', $ticket->subject) }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-3 col-form-label">Message <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="message" name="message" rows="4" required>{{ old('message', $ticket->message) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requester_name" class="col-sm-3 col-form-label">Requester Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="requester_name" name="requester_name" value="{{ old('requester_name', $ticket->requester_name) }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requester_email" class="col-sm-3 col-form-label">Requester Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="requester_email" name="requester_email" value="{{ old('requester_email', $ticket->requester_email) }}" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requester_phone" class="col-sm-3 col-form-label">Requester Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="requester_phone" name="requester_phone" value="{{ old('requester_phone', $ticket->requester_phone) }}" maxlength="255">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="new" @selected(old('status', $ticket->status->value ?? $ticket->status) === 'new')>New</option>
                                            <option value="open" @selected(old('status', $ticket->status->value ?? $ticket->status) === 'open')>Open</option>
                                            <option value="responded" @selected(old('status', $ticket->status->value ?? $ticket->status) === 'responded')>Responded</option>
                                        </select>
                                    </div>
                                    <label for="priority" class="col-sm-2 col-form-label">Priority <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="priority" name="priority" required>
                                            <option value="low" @selected(old('priority', $ticket->priority) === 'low')>Low</option>
                                            <option value="normal" @selected(old('priority', $ticket->priority) === 'normal')>Normal</option>
                                            <option value="high" @selected(old('priority', $ticket->priority) === 'high')>High</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="channel" class="col-sm-3 col-form-label">Channel <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="channel" name="channel" required>
                                            <option value="website" @selected(old('channel', $ticket->channel) === 'website')>Website</option>
                                            <option value="email" @selected(old('channel', $ticket->channel) === 'email')>Email</option>
                                            <option value="phone" @selected(old('channel', $ticket->channel) === 'phone')>Phone</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="response_message" class="col-sm-3 col-form-label">Response Message</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="response_message" name="response_message" rows="4">{{ old('response_message', $ticket->response_message) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('partials.toastr')
@stop