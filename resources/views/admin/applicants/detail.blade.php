@extends('adminlte::page')

@section('title', 'Papandayan | Career Applicants Detail')

@section('plugins.Datatables', true)
@section('plugins.TempusDominusBs4', true)
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

    $jobStatus = getJobStatus($career->posting_at, $career->closing_at);

    function getStatusBadgeClass($status) {
        return match(strtolower($status)) {
            'new' => 'bg-info',
            'rejected' => 'bg-danger',
            'approved' => 'bg-success',
            default => 'bg-secondary'
        };
    }

    function getStatusDisplayText($status) {
        return match(strtolower($status)) {
            'new' => 'New',
            'rejected' => 'Rejected',
            'approved' => 'Approved',
            default => ucfirst($status)
        };
    }
@endphp

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Applicants for {{ $career->position }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.applicants.index') }}">Applicants</a></li>
                <li class="breadcrumb-item active">{{ $career->position }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Career Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Position:</strong>
                            <p>{{ $career->position }}</p>
                        </div>
                        <div class="col-md-3">
                            <strong>Location:</strong>
                            <p>{{ $career->location }}</p>
                        </div>
                        <div class="col-md-3">
                            <strong>Posting At:</strong>
                            <p>{{ $career->posting_at->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-3">
                            <strong>Closing At:</strong>
                            <p>{{ $career->closing_at->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <p><span class="badge {{ getJobStatusBadgeClass($jobStatus) }}">{{ getJobStatusDisplayText($jobStatus) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Total Applicants:</strong>
                            <p><span class="badge bg-info">{{ $applicants->count() }} applicant(s)</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Applicants List</h3>
                </div>
                <div class="card-body">
                    <table id="datagrid" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px;">No</th>
                                <th style="width: 180px;">Name</th>
                                <th style="width: 180px;">Email</th>
                                <th style="width: 160px;">Phone Number</th>
                                <th style="width: 100px;">Education</th>
                                <th scope="col">Status</th>
                                <th style="width: 70px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach($applicants as $applicant)
                                <tr>
                                    <td scope="row">{{ $index }}</td>
                                    <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                    <td>{{ $applicant->email }}</td>
                                    <td>{{ $applicant->phone_number }}</td>
                                    <td>{{ $applicant->education }} {{ $applicant->major }}</td>
                                    <td><span class="badge {{ getStatusBadgeClass($applicant->status) }}">{{ getStatusDisplayText($applicant->status) }}</span></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary item-detail" data-id="{{ $applicant->id }}"><i class="fas fa-eye"></i></a>
                                        @if($applicant->curriculum_vitae)
                                            <a href="{{ asset('storage/' . $applicant->curriculum_vitae) }}" class="btn btn-sm btn-success item-download" target="_blank" title="Download CV">
                                                <i class="fas fa-download"></i>
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

            <!-- Detail Modal -->
            <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Applicant Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumber">Phone Number</label>
                                        <input type="text" class="form-control" id="phoneNumber" name="phone_number" placeholder="Phone Number" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="bod">Birth of Date</label>
                                        <div class="input-group date" id="bod" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="bod" data-target="#bod" placeholder="dd-MM-yyyy" disabled/>
                                            <div class="input-group-append" data-target="#bod" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text" class="form-control" id="education" name="education" placeholder="Education" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="experienced">Experienced</label>
                                        <input type="text" class="form-control" id="experienced" name="experienced" placeholder="Experienced" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="currentSalary">Current Salary</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="form-control" id="currentSalary" name="current_salary" placeholder="Current Salary" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="expectationSalary">Expectation Salary</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="form-control" id="expectationSalary" name="expectation_salary" placeholder="Expectation Salary" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" placeholder="Status" readonly>
                                    </div>
                                    <div class="form-group" id="rejectReasonGroup" style="display: none;">
                                        <label for="viewRejectReason">Reject Reason</label>
                                        <textarea class="form-control" id="viewRejectReason" name="reject_reason" placeholder="Reject Reason" rows="3" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-primary">Work Experience Details</h5>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table id="datagrid" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">No</th>
                                                <th style="width: 350px;">Company Name</th>
                                                <th style="width: 200px;">Industry</th>
                                                <th scope="col">Position</th>
                                                <th style="width: 150px;">Duration</th>
                                            </tr>
                                        </thead>
                                        <tbody id="experience-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" id="btn-modal-cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" id="btn-modal-reject" class="btn btn-danger">Reject</button>
                            <button type="button" id="btn-modal-approve" class="btn btn-primary">Approve</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden Form for Detail Action -->
            <form id="detail-form" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                @method('PUT')
            </form>

            <!-- Reject Modal -->
            <div class="modal fade" id="modal-reject" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Rejection Confirmation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="modalRejectReason">Reject Reason <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="modalRejectReason" name="reject_reason" maxlength="500" placeholder="Reject Reason" rows="4" required></textarea>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" id="btn-modal-cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" id="btn-modal-save" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden Form for Reject Action -->
            <form id="reject-form" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                @method('PUT')
            </form>
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
            var applicantsData = @json($applicants);
            
            // Initialize DatePicker
            $('#bod').datetimepicker({
                format: 'DD-MM-YYYY'
            });

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
                    
                    $('#datagrid_length label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).remove();
                }
            });
            
            // Function to Format Currency
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID').format(amount);
            }
            
            // Function to Format Date
            function formatDate(dateString) {
                if (!dateString) return '';
                var date = new Date(dateString);
                var day = String(date.getDate()).padStart(2, '0');
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var year = date.getFullYear();
                return day + '-' + month + '-' + year;
            }
            
            // Function to load Applicant Data into modal
            function loadApplicantData(applicantId) {
                var applicant = applicantsData.find(function(item) {
                    return item.id == applicantId;
                });
                
                if (applicant) {
                    $('#fullName').val(applicant.first_name + ' ' + applicant.last_name);
                    $('#email').val(applicant.email);
                    $('#phoneNumber').val(applicant.phone_number);
                    $('#bod input').val(formatDate(applicant.bod));
                    $('#education').val(applicant.education + ' ' + applicant.major);
                    $('#experienced').val(applicant.experienced);
                    $('#currentSalary').val(formatCurrency(applicant.current_salary));
                    $('#expectationSalary').val(formatCurrency(applicant.expectation_salary));
                    $('#status').val(applicant.status.charAt(0).toUpperCase() + applicant.status.slice(1));
                    $('#viewRejectReason').val(applicant.reject_reason || '');
                    
                    // Show or hide Reject Reason based on Status
                    if (applicant.status.toLowerCase() === 'rejected') {
                        $('#rejectReasonGroup').show();
                    } else {
                        $('#rejectReasonGroup').hide();
                    }
                    
                    // Load Experience Data
                    var experienceTbody = $('#experience-tbody');
                    experienceTbody.empty();
                    
                    if (applicant.experienced_applicant) {
                        var exp = applicant.experienced_applicant;
                        var row = '<tr>' +
                            '<td>1</td>' +
                            '<td>' + exp.company_name + '</td>' +
                            '<td>' + exp.industry + '</td>' +
                            '<td>' + exp.position + '</td>' +
                            '<td>' + exp.duration + ' Month</td>' +
                            '</tr>';
                        experienceTbody.append(row);
                    } else {
                        experienceTbody.append('<tr><td colspan="5" class="text-center">No data available in table</td></tr>');
                    }
                }
            }
            
            // Modal Detail Button Handler
            $(document).on("click", ".item-detail", function(){
                selectedRow = $(this).data("id");
                loadApplicantData(selectedRow);
                $("#modal-detail").modal("show");
            });
            
            // Approve Button Handler
            $("#btn-modal-approve").on("click", function(){
                if (!selectedRow) {
                    toastr.error('No applicant selected');
                    return;
                }
                
                var form = $("#detail-form");
                form.empty();
                form.append('@csrf');
                form.append('@method("PUT")');
                form.append($('<input>').attr({
                    type: "hidden",
                    name: "status",
                    value: "Approved"
                }));
                form.append($('<input>').attr({
                    type: "hidden",
                    name: "reject_reason",
                    value: ""
                }));
                form.attr("action", "{{ url('admin/applicants') }}/" + selectedRow);
                form.submit();
            });

            // Modal Reject Button Handler
            $("#btn-modal-reject").on("click", function(){
                if (!selectedRow) {
                    toastr.error('No applicant selected');
                    return;
                }

                $("#modal-detail").modal("hide");
                $("#modalRejectReason").val('');
                $("#modal-reject").modal("show");
            });

            // Reject Save Button Handler
            $("#btn-modal-save").on("click", function(){
                var rejectReason = $("#modalRejectReason").val().trim();
                
                if (!rejectReason) {
                    toastr.error('Please enter a reject reason');
                    return;
                }
                
                if (!selectedRow) {
                    toastr.error('No applicant selected');
                    return;
                }
                
                var form = $("#reject-form");
                form.empty();
                form.append('@csrf');
                form.append('@method("PUT")');
                form.append($('<input>').attr({
                    type: "hidden",
                    name: "status",
                    value: "Rejected"
                }));
                form.append($('<input>').attr({
                    type: "hidden",
                    name: "reject_reason",
                    value: rejectReason
                }));
                form.attr("action", "{{ url('admin/applicants') }}/" + selectedRow);
                form.submit();
            });
        });
    </script>
@stop