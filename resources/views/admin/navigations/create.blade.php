@extends('adminlte::page')

@section('title', 'Papandayan | Add Menu Navigation')

@section('plugins.Select2', true)
@section('plugins.Toastr', true)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Menu Navigation</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.navigations.index') }}">Menu Navigations</a></li>
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
                    <h3 class="card-title">Form Menu Navigation</h3>
                </div>
                <form method="POST" action="{{ route('admin.navigations.store') }}" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" maxlength="255" placeholder="Name" required>
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="url" class="col-sm-3 col-form-label">URL <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" maxlength="255" placeholder="URL" required>
                                        <span class="error invalid-feedback">{{ $errors->first('url') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="isActive" class="col-sm-3 col-form-label">Is Active <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-switch" style="margin-top: 7px;">
                                            <input type="hidden" name="is_active" value="false">
                                            <input type="checkbox" class="custom-control-input" id="isActive" value="true" name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="isActive"></label>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('is_active') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" maxlength="255" placeholder="Icon (e.g. fas fa-home)">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="icon-preview">
                                                    <i class="{{ old('icon', 'fas fa-question') }}"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="error invalid-feedback">{{ $errors->first('icon') }}</span>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-md btn-primary icon-detail"><i class="fas fa-search"></i></a>
                                </div>
                                <div class="form-group row">
                                    <label for="menuGroup" class="col-sm-3 col-form-label">Menu Group <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2bs4" style="width: 100%;" id="menuGroup" name="menu_group_id" required>
                                            <option value="">-- Select Group --</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error invalid-feedback">{{ $errors->first('menu_group_id') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.navigations.index') }}" class="btn btn-default" style="margin-right: 5px">Back</a>
                        <button type="reset" class="btn btn-secondary" style="margin-right: 5px">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

            <!-- Icon Modal -->
            <div class="modal fade" id="modal-icon" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Icon</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="icon-grid">
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-home"><i class="fas fa-home"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-user"><i class="fas fa-user"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-cog"><i class="fas fa-cog"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-chart-bar"><i class="fas fa-chart-bar"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-users"><i class="fas fa-users"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-envelope"><i class="fas fa-envelope"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-phone"><i class="fas fa-phone"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-calendar"><i class="fas fa-calendar"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-file"><i class="fas fa-file"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-folder"><i class="fas fa-folder"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-edit"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-trash"><i class="fas fa-trash"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-plus"><i class="fas fa-plus"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-minus"><i class="fas fa-minus"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-search"><i class="fas fa-search"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-star"><i class="fas fa-star"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-heart"><i class="fas fa-heart"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-bell"><i class="fas fa-bell"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-shopping-cart"><i class="fas fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0)" class="icon-option" data-icon="fas fa-info"><i class="fas fa-info"></i></a>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" id="btn-modal-cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
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
        
        /* Icon Grid Styles */
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            padding: 10px;
        }
        
        .icon-option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            color: #495057;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
        }
        
        .icon-option:hover {
            border-color: #007bff;
            background-color: #e7f3ff;
            color: #007bff;
            text-decoration: none;
            transform: translateY(-2px);
        }
        
        .icon-option.selected {
            border-color: #007bff;
            background-color: #007bff;
            color: white;
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

            // Modal Icon Button Handler
            $(document).on("click", ".icon-detail", function(){
                $("#modal-icon").modal("show");
            });
            
            // Icon Selection Handler
            $(document).on("click", ".icon-option", function(){
                // Remove selected class from all icons
                $('.icon-option').removeClass('selected');
                
                // Add selected class to clicked icon
                $(this).addClass('selected');
                
                // Get the icon class from data-icon attribute
                var iconClass = $(this).data('icon');
                
                // Set the icon class to input field
                $('#icon').val(iconClass);
                
                // Update icon preview
                updateIconPreview();
                
                // Close the modal
                $('#modal-icon').modal('hide');
                
                // Optional: Show success message
                toastr.success('Icon selected successfully!');
            });
            
            // Clear selection when modal is closed
            $('#modal-icon').on('hidden.bs.modal', function () {
                $('.icon-option').removeClass('selected');
            });
            
            // Function to update icon preview
            function updateIconPreview() {
                var iconClass = $('#icon').val();
                if (iconClass && iconClass.trim()) {
                    $('#icon-preview i').attr('class', iconClass);
                } else {
                    $('#icon-preview i').attr('class', 'fas fa-question');
                }
            }
            
            // Initialize icon preview on page load
            updateIconPreview();
            
            // Update icon preview when input changes
            $('#icon').on('input', function() {
                updateIconPreview();
            });
            
        });
    </script>
@stop