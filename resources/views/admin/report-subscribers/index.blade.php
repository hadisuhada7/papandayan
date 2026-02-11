@extends('adminlte::page')

@section('title', 'Papandayan | Report Subscribers')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@php
function subscriberStatusBadge(bool $isActive): string {
    return $isActive ? 'bg-success' : 'bg-secondary';
}

function subscriberStatusLabel(bool $isActive): string {
    return $isActive ? 'Aktif' : 'Tidak Aktif';
}
@endphp

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Report Subscribers</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Report Subscribers</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">List Subscriber Notifikasi Laporan</h3>
                </div>
                <div class="card-body">
                    <table id="datagrid" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th>Email</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 180px;">Subscribed At</th>
                                <th style="width: 180px;">Unsubscribed At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 1; @endphp
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>
                                        <span class="badge {{ subscriberStatusBadge($subscriber->is_active) }}">
                                            {{ subscriberStatusLabel($subscriber->is_active) }}
                                        </span>
                                    </td>
                                    <td>{{ $subscriber->subscribed_at?->format('d M Y H:i') ?? '-' }}</td>
                                    <td>{{ $subscriber->unsubscribed_at?->format('d M Y H:i') ?? '-' }}</td>
                                </tr>
                                @php $index++; @endphp
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
        #datagrid_filter input {
            margin-left: 0 !important;
            width: 180px;
            border-radius: 3px;
        }

        #datagrid_length {
            float: left !important;
        }
    </style>
@stop

@section('js')
    @include('partials.toastr')
    <script type="text/javascript">
        $(document).ready(function () {
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
                initComplete: function() {
                    $('#datagrid_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();

                    $('#datagrid_filter input')
                        .attr('placeholder', 'Search')
                        .attr('id', 'datagrid_search')
                        .attr('name', 'datagrid_search')
                        .addClass('form-control input-sm');

                    $('#datagrid_length label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();
                }
            });
        });
    </script>
@stop
