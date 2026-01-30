@extends('adminlte::page')

@section('title', 'Papandayan | Add Branch')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Branch</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.areas.index') }}">Branches</a></li>
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
                    <h3 class="card-title">Form Branch</h3>
                </div>
                <form method="POST" action="{{ route('admin.areas.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="partnerName" class="col-sm-3 col-form-label">Branch Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="partnerName" name="partner_name" value="{{ old('partner_name') }}" maxlength="255" placeholder="Branch Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('partner_name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="numberOfCages" class="col-sm-3 col-form-label">Number of Farms <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control number-only" id="numberOfCages" name="number_of_cages" value="{{ old('number_of_cages') }}" maxlength="5" placeholder="Number of Farms" required>
                                        <span class="error invalid-feedback">{{ $errors->first('number_of_cages') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="area" class="col-sm-3 col-form-label">Regional <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="area" name="area" value="{{ old('area') }}" maxlength="255" placeholder="Regional" required>
                                        <span class="error invalid-feedback">{{ $errors->first('area') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="latitude" class="col-sm-3 col-form-label">Latitude <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" maxlength="255" placeholder="Latitude" required>
                                        <span class="error invalid-feedback">{{ $errors->first('latitude') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="longitude" class="col-sm-3 col-form-label">Longitude <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" maxlength="255" placeholder="Longitude" required>
                                        <span class="error invalid-feedback">{{ $errors->first('longitude') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.areas.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- add stylesheets --}}
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
            // Numeric Input Restriction
            $(document).on("keypress", ".number-only", function (e) {
                return ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"].includes(e.key)
            });
        });
    </script>
@stop