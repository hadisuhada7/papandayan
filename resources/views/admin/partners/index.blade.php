@extends('adminlte::page')

@section('title', 'Papandayan | Partners')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Partners</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Partners</li>
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
                                <th style="width: 150px;">Full Name</th>
                                <th scope="col">Email</th>
                                <th style="width: 150px;">Phone Number</th>
                                <th style="width: 200px;">Company Name</th>
                                <th style="width: 25px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $index = 1; 
                            @endphp
                            @foreach($partners as $partner)
                                <tr>
                                    <td scope="row">{{ $index }}</td>
                                    <td>{{ $partner->full_name }}</td>
                                    <td>{{ $partner->email }}</td>
                                    <td>{{ $partner->phone_number }}</td>
                                    <td>{{ $partner->company_name }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info item-detail" data-id="{{ $partner->id }}"><i class="fas fa-eye"></i></a>
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
                    { targets: 5, orderable: false }
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

                    // $('<a href="{{ route('admin.partners.create') }}" class="btn btn-sm btn-primary" style="margin-left: 10px;">Add New</a>')
                    //     .appendTo($('#datagrid_filter'));
                    
                    $('#datagrid_length label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();
                }
            });

            // Handle eye button click to redirect to detail page
            $(document).on('click', '.item-detail', function() {
                var selectedRow = $(this).data('id');
                var detailUrl = '{{ route("admin.partners.show", ":id") }}'.replace(':id', selectedRow);
                window.location.href = detailUrl;
            });
        });
    </script>
@stop