@extends('adminlte::page')

@section('title', 'Papandayan | Edit Question')

@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Question</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">Questions</a></li>
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
                    <h3 class="card-title">Form Question</h3>
                </div>
                <form method="POST" action="{{ route('admin.questions.update', $question) }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $question->name }}" maxlength="255" placeholder="Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $question->email }}" maxlength="255" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Email" required>
                                        <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control number-only" id="phoneNumber" name="phone_number" value="{{ $question->phone_number }}" maxlength="15" pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$" placeholder="Phone Number" required>
                                        <span class="error invalid-feedback">{{ $errors->first('phone_number') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="questionType" class="col-sm-3 col-form-label">Question Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="questionType" name="question_type_id" required>
                                            <option value="{{ $question->question_type_id }}">{{ $question->question_type->name }}</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('question_type_id') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="status" name="status" required>
                                            <option value="{{ $question->status }}">{{ $question->status }}</option>
                                            <option value="Open">Open</option>
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Closed">Closed</option>
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-3 col-form-label">Message <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="message" name="message" maxlength="65535" placeholder="Message" required>{{ $question->message }}</textarea>
                                        <span class="error invalid-feedback">{{ $errors->first('message') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.questions.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            // Numeric Input Restriction
            $(document).on("keypress", ".number-only", function (e) {
                return ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(e.key)
            });
        });
    </script>
@stop