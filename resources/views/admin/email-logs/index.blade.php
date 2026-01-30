@extends('adminlte::page')

@section('title', 'Papandayan | Email Logs')

@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@php
function emailLogStatusBadge($status) {
    return match(strtolower($status)) {
        'queued' => 'bg-secondary',
        'sent' => 'bg-success',
        'failed' => 'bg-danger',
        default => 'bg-secondary'
    };
}

function emailLogStatusLabel($status) {
    return match(strtolower($status)) {
        'queued' => 'Queued',
        'sent' => 'Sent',
        'failed' => 'Failed',
        default => ucfirst($status)
    };
}
@endphp

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Email Logs</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Email Logs</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Log Pengiriman Email</h3>
                </div>
                <div class="card-body">
                    <table id="datagrid" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th>Recipient</th>
                                <th>Subject</th>
                                <th>Template</th>
                                <th>Status</th>
                                <th style="width: 160px;">Sent At</th>
                                <th style="width: 60px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $index = 1; @endphp
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>
                                        <div>{{ $log->recipient_email }}</div>
                                        <small class="text-muted">Ticket: {{ $log->ticket?->ticket_number ?? '-' }}</small>
                                    </td>
                                    <td>{{ $log->subject }}</td>
                                    <td>{{ $log->template }}</td>
                                    <td><span class="badge {{ emailLogStatusBadge($log->status) }}">{{ emailLogStatusLabel($log->status) }}</span></td>
                                    <td>{{ $log->sent_at?->format('d M Y H:i') ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.email-logs.show', $log) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    </td>
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
                columnDefs: [
                    { targets: 6, orderable: false }
                ],
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