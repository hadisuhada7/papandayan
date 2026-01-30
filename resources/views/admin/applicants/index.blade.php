@extends('adminlte::page')

@section('title', 'Papandayan | Career Applicants')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@php
    function getJobStatus($postingDate, $closingDate) {
        $today = \Carbon\Carbon::today();
        
        if ($today->gt($closingDate)) {
            return 'closed';
        }
        
        if ($today->gte($postingDate) && $today->lte($closingDate)) {
            return 'open';
        }
        
        return 'pending';
    }

    function getJobStatusBadgeClass($status) {
        return match($status) {
            'open' => 'bg-success',
            'closed' => 'bg-danger',
            'pending' => 'bg-warning',
            default => 'bg-secondary'
        };
    }

    function getJobStatusDisplayText($status) {
        return match($status) {
            'open' => 'Open',
            'closed' => 'Closed',
            'pending' => 'Pending',
            default => ucfirst($status)
        };
    }
@endphp

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Career Applicants</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Applicants</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Tables</h3>
                </div>
                <div class="card-body">
                    <table id="datagrid" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th style="width: 160px;">Position</th>
                                <th style="width: 160px;">Location</th>
                                <th style="width: 150px;">Closing At</th>
                                <th scope="col">Status</th>
                                <th style="width: 150px;">Total Applicants</th>
                                <th style="width: 65px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $index = 1; 
                            @endphp
                            @foreach($careers as $career)
                                @php 
                                    $jobStatus = getJobStatus($career->posting_at, $career->closing_at);
                                @endphp
                                <tr>
                                    <td scope="row">{{ $index }}</td>
                                    <td>{{ $career->position }}</td>
                                    <td>{{ $career->location }}</td>
                                    <td>{{ $career->closing_at->format('d F Y') }}</td>
                                    <td><span class="badge {{ getJobStatusBadgeClass($jobStatus) }}">{{ getJobStatusDisplayText($jobStatus) }}</span></td>
                                    <td>{{ $career->career_applicants_count ?? 0 }}</td>
                                    <td class="text-center">
                                        @if($career->career_applicants_count > 0)
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary item-detail" data-id="{{ $career->id }}"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.applicants.export.career', $career->id) }}" class="btn btn-sm btn-success item-export" title="Export to Excel">
                                                <i class="fas fa-file-excel"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @php 
                                    $index++; 
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">
        /* Modify DataGrid Filter */
        #datagrid_filter input {
            margin-left: 0 !important;
            width: 180px;
            border-radius: 3px;
        }

        /* Modify DataGrid Length */
        #datagrid_length {
            float: left !important;
        }
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {

            var selectedRow;

            // Initialize DataTable
            $("#datagrid").DataTable({
                paging: true,
                ordering: true,
                searching: true,
                responsive: true, 
                lengthChange: true, 
                autoWidth: false,
                language: {
                    emptyTable: "No data available in table",
                    zeroRecords: "No matching records found"
                },

                columnDefs: [
                    { targets: 6, orderable: false }
                ],

                initComplete: function(settings, json) {
                    $('#datagrid_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();

                    $('#datagrid_filter input')
                        .attr('placeholder', 'Search')
                        .attr('id', 'datagrid_search')
                        .attr('name', 'datagrid_search')
                        .addClass('form-control input-sm');

                    $('<a href="{{ route('admin.applicants.create') }}" class="btn btn-sm btn-primary" style="margin-left: 10px;">Add New</a>')
                        .appendTo($('#datagrid_filter'));
                    
                    $('#datagrid_length label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();
                }
            });

            // Handle eye button click to redirect to detail page
            $(document).on('click', '.item-detail', function() {
                var selectedRow = $(this).data('id');
                var detailUrl = '{{ route("admin.applicants.career", ":id") }}'.replace(':id', selectedRow);
                window.location.href = detailUrl;
            });
        });
    </script>
@stop