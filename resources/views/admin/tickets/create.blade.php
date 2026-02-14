@extends('adminlte::page')

@section('title', 'Papandayan | Add Ticket')

@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Ticket</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>
                <li class="breadcrumb-item active">Add</li>
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
                <form method="POST" action="{{ route('admin.tickets.store') }}" class="form-horizontal">
                    @csrf
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
                                    <label for="questionId" class="col-sm-3 col-form-label">Linked Question</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2bs4" style="width: 100%;" id="questionId" name="question_id">
                                            <option value="">-- Select Question --</option>
                                            @foreach ($questions as $question)
                                                <option value="{{ $question->id }}" @selected(old('question_id') == $question->id)>
                                                    {{ $question->name }} - {{ $question->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('question_id') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-sm-3 col-form-label">Subject <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" maxlength="255" placeholder="Subject" required>
                                        <span class="error invalid-feedback">{{ $errors->first('subject') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-3 col-form-label">Message <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message" required>{{ old('message') }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('message') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requesterName" class="col-sm-3 col-form-label">Requester Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="requesterName" name="requester_name" value="{{ old('requester_name') }}" maxlength="255" placeholder="Requester Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('requester_name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requesterEmail" class="col-sm-3 col-form-label">Requester Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="requesterEmail" name="requester_email" value="{{ old('requester_email') }}" maxlength="255" placeholder="Requester Email" required>
                                        <span class="error invalid-feedback">{{ $errors->first('requester_email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requesterPhone" class="col-sm-3 col-form-label">Requester Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="requesterPhone" name="requester_phone" value="{{ old('requester_phone') }}" maxlength="255" placeholder="Requester Phone">
                                        <span class="error invalid-feedback">{{ $errors->first('requester_phone') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2bs4" style="width: 100%;" id="status" name="status" required>
                                            <option value="">-- Select Status --</option>
                                            <option value="new" @selected(old('status') === 'new')>New</option>
                                            <option value="open" @selected(old('status') === 'open')>Open</option>
                                            <option value="responded" @selected(old('status') === 'responded')>Responded</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    </div>
                                    <label for="priority" class="col-sm-2 col-form-label">Priority <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="priority" name="priority" required>
                                            <option value="">-- Select Priority --</option>
                                            <option value="low" @selected(old('priority') === 'low')>Low</option>
                                            <option value="normal" @selected(old('priority', 'normal') === 'normal')>Normal</option>
                                            <option value="high" @selected(old('priority') === 'high')>High</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('priority') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="channel" class="col-sm-3 col-form-label">Channel <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2bs4" style="width: 100%;" id="channel" name="channel" required>
                                            <option value="">-- Select Channel --</option>
                                            <option value="website" @selected(old('channel', 'website') === 'website')>Website</option>
                                            <option value="email" @selected(old('channel') === 'email')>Email</option>
                                            <option value="phone" @selected(old('channel') === 'phone')>Phone</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('channel') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">
        /* Modify Select2 */
        .select2-container--bootstrap4 .select2-selection--single:focus,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--single {
            box-shadow: none !important;
        }

        .select2-container--bootstrap4 .select2-selection--multiple:focus,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--multiple {
            box-shadow: none !important;
        }
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@stop