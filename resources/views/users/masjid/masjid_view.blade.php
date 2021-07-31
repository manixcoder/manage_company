@extends('users.master')
@section('pageTitle', 'Comapny')
@section('pageCss')
@stop
@section('content')
<?php
// dd($masjidData['id']);
?>

<div class="container-fluid">
    @if(Session::has('status'))
    <div class="alert alert-{{ Session::get('status') }}">
        <i class="ti-user"></i> {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        @if($masjidData['profile_photo'] !='')
                        <img src="{{ asset('public/uploads/userProfile/'.$masjidData['profile_photo']) }}" class="img-circle" width="150" />
                        @else
                        <img src="{{ asset('public/assets/admin/images/users/profile-photo.jpg') }}" class="img-circle" width="150" />
                        @endif

                        <h4 class="card-title m-t-10">{{ $masjidData['name'] }}</h4>
                        <h6 class="card-subtitle"></h6>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <small class="text-muted">Email address </small>
                    <h6>{{ $masjidData['email'] }}</h6>
                    <small class="text-muted p-t-30 db">Phone</small>
                    <h6>{{ $masjidData['phone'] }}</h6>
                    <!-- <small class="text-muted p-t-30 db">Address</small>
                    <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                    <div class="map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>  -->
                    <!-- <small class="text-muted p-t-30 db">Social Profile</small>
                    <br />
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button> -->
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Compains Listing</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="settings" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="right-side-struct pull-right">
                                    <button type="button" class="btn btn-info waves-effect waves-light clearfix add-new add-faicon" data-toggle="modal" data-target="#addMasjidCompain"><i class="fa fa-plus" aria-hidden="true"></i> Add New Compain </button>
                                </div>
                                <h4 class="card-title m-b-0">Total Earning</h4>
                                <h2 class="m-t-0">$ 0.0</h2>
                                <div class="table-responsive m-t-40">
                                    @if(Session::has('status'))
                                    <div class="alert alert-{{ Session::get('status') }}">
                                        <i class="ti-user"></i> {{ Session::get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                    </div>
                                    @endif

                                    <table id="dataTable" class=" table table-striped table-bordered dataTable  ">
                                        <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Compains Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trigger the modal with a button -->
    <!-- Modal -->
    <div id="addMasjidCompain" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Add Compain </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body clearfix">
                    <form id="addCompain">
                        {{csrf_field() }}
                        <br>
                        <input type="hidden" name="masjidId" id="masjidId" value="{{ $masjidData['id'] }}">
                        <div class="form-group">
                            <label for="compainName" class="col-md-12 control-label">Compain Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="compainName" name="compainName" value="{{ old('compainName') }}">
                                <small class="error form-control-feedback" id="error-compainName"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="compainDesc" class="col-md-12 control-label">Description</label>
                            <div class="col-md-12">
                                <textarea name="compainDesc" class="form-control">{{ old('compainDesc') }}</textarea>
                                <small class="error form-control-feedback" id="error-compainDesc"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="compainDesc" class="col-md-12 control-label">Status</label>
                            <div class="col-md-12">
                                <select name="is_active" id="is_active" class="form-control">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                                <small class="error form-control-feedback" id="error-is_active"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="compainLogo" class="col-md-12 control-label">Compain Logo</label>
                            <div class="col-md-12">
                                <input type="file" id="avatar" class="form-control @error('compainLogo') form-control-danger @enderror " name="compainLogo" value="{{ old('compainLogo') }}" req />
                                <small class="error form-control-feedback" id="error-compainLogo"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info waves-effect waves-light save-btn">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Model End here -->

    <!-- Trigger the modal with a button -->
    <!-- Modal -->
    <div id="editMasjidCompain" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Edit Compain </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body clearfix">
                    <form id="editCompain">
                        {{csrf_field() }}
                        <input type="hidden" name="compainId">
                        <br>
                        <div class="form-group">
                            <label for="compainName" class="col-md-12 control-label">Compain Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="edit_compainName" name="edit_compainName" value="{{ old('compainName') }}">
                                <small class="error form-control-feedback" id="error-edit_compainName"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_compainDesc" class="col-md-12 control-label">Description</label>
                            <div class="col-md-12">
                                <textarea name="edit_compainDesc" class="form-control">{{ old('edit_compainDesc') }}</textarea>
                                <small class="error form-control-feedback" id="error-edit_compainDesc"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_compainStatus" class="col-md-12 control-label">Status</label>
                            <div class="col-md-12">
                                <select name="edit_is_active" id="edit_is_active" class="form-control">
                                    <option value="">-Select Status-</option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select>
                                <small class="error form-control-feedback" id="error-edit_is_active"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editcompainLogo" class="col-md-12 control-label">Compain Logo</label>
                            <div class="col-md-12">
                                <img src="" id="compainLogoThumb" height="100" width="100">
                                <input type="file" id="editcompainLogo" class="form-control @error('compainLogo') form-control-danger @enderror " name="compainLogo" value="{{ old('compainLogo') }}" />
                                <small class="error form-control-feedback" id="error-compainLogo"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info waves-effect waves-light save-btn">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Model End here -->
    @endsection
    @section('pagejs')
    <script type="text/javascript">
        $(function() {
            /* 
            |--------------------------------------------------------
            |	Description	:	Code for Get Data                   |
            |	Date		:	01/Oct/2019                         |
            |--------------------------------------------------------
            */

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url( "/admin/masjid-compain/compain-data") !!}/' + '{{ $masjidData->id }}',
                columns: [{
                        data: 'compainLogo',
                        name: 'compainLogo',
                        orderable: false,
                        render: function(data, type, row) {
                            if (row.compainLogo != "" || row.compainLogo != null) {
                                var ImgURL = "{!!  url( '/public/uploads/CompainLogo') !!}/" + row.compainLogo;
                                return '<img src="' + ImgURL + '" width="50" height="50" class="img-circle" alt="logo" /> ';
                            } else {
                                return '<span class="round">N/A</span>';
                            }

                        }
                    },

                    {
                        data: 'compainName',
                        name: 'compainName',
                        orderable: true
                    },
                    {
                        data: 'compainDesc',
                        name: 'compainDesc',
                        orderable: true
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        orderable: true,
                        render: function(data, type, row) {
                            if (row.is_active == 1) {
                                var status = 'success';
                                var text = 'Active';
                            } else {
                                var status = 'danger';
                                var text = 'Inactive';
                            }
                            return '<span class="label label-' + status + '"> ' + text + ' </span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                lengthMenu: [10, 25, 50, 100],
                order: [
                    [1, 'desc']
                ],
                dom: 'Blfrptip',
                buttons: [{
                    extend: 'colvis',
                    text: "Show / Hide Columns"
                }],
                oLanguage: {
                    sProcessing: "<img height='80' width='80' src='{{ url('public/assets/admin/images/loading.gif') }}' alt='loader'/>",
                    "oPaginate": {
                        "sPrevious": "Previous", // This is the link to the previous page
                        "sNext": "Next",
                    },
                    "sSearch": "Search",
                    "sLengthMenu": "Show _MENU_ entries",
                    "sInfo": "Showing _START_ to _END_ of _TOTAL_ enteris",
                    "sInfoEmpty": "Showing 0 to 0 of 0 entries",
                    "sInfoFiltered": "search filtered entries",
                    "sZeroRecords": "No matching records found",
                    "sEmptyTable": "Compain data available in table",
                },
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function() {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });
            /* 
            |--------------------------------------------------------
            |	Description	:	Code for Auto Key Slug              |
            |	Date		:	01/Oct/2019                         |
            |--------------------------------------------------------
            */
            $("#name").keyup(function() {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                var regExp = /\s+/g;
                Text = Text.replace(regExp, '-');
                $(this).val(Text);
            });
        });

        /* 
        |--------------------------------------------------------
        |	Description	:	Code for Submit form                |
        |	Date		:	01/Oct/2019                         |
        |--------------------------------------------------------
        */
        $(document).on('submit', '#addCompain', function() {
            $('#dataTable_processing').show();
            var FormId = document.getElementById("addCompain");
            var formData = new FormData(FormId);
            $.ajax({
                'url': "{!!  url( '/admin/insurance-company-management/save-compain') !!}",
                'method': 'post',
                'dataType': 'json',
                'data': formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#dataTable_processing').hide();
                    if (data.status == 'success') {
                        swal("Success", data.message, "success").then(function() {
                            window.location.reload();
                        });

                    } else if (data.status == 'exception' || data.status == 'danger') {
                        swal("Error", data.message, "error");
                    } else {
                        swal("Action failed", "Please fill required fields", "error");
                        $('.error').html('');
                        $('.error').parent().removeClass('has-danger');
                        $.each(data, function(key, value) {
                            if (value != "") {
                                $("#error-" + key).text(value);
                                $("#error-" + key).parent().addClass('has-danger');
                            }
                        });
                    }

                }

            });
            return false;
        });

        /* 
        |--------------------------------------------------------
        |	Description	:	Code for Edit Compain               |
        |	Date		:	01/Oct/2019                         |
        |--------------------------------------------------------
        */
        $(document).on('submit', '#editCompain', function() {
            $('#dataTable_processing').show();
            var FormId = document.getElementById("editCompain");
            var formData = new FormData(FormId);
            $.ajax({
                'url': "{!!  url( '/admin/masjid-compain/update') !!}",
                'method': 'post',
                'dataType': 'json',
                'data': formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#dataTable_processing').hide();
                    if (data.status == 'success') {
                        swal("Success", data.message, "success").then(function() {
                            window.location.reload();
                        });

                    } else if (data.status == 'exception' || data.status == 'danger') {
                        swal("Error", data.message, "error");
                    } else {
                        swal("Action failed", "Please fill required fields", "error");
                        $('.error').html('');
                        $('.error').parent().removeClass('has-danger');
                        $.each(data, function(key, value) {
                            if (value != "") {
                                $("#error-" + key).text(value);
                                $("#error-" + key).parent().addClass('has-danger');
                            }
                        });
                    }

                }

            });
            return false;
        });

        $(document).on('click', 'a.editCompain', function() {
            var capId = $(this).attr('data-id');
            $.ajax({
                'url': "{!!  url( '/admin/masjid-compain/') !!}/" + capId + '/edit',
                'method': 'get',
                'dataType': 'json',

                success: function(response) {
                    if (response.status == 'success') {
                        $("input[name=compainId]").val(capId);
                        $("input[name=edit_compainName]").val(response.data.compainName);
                        $("textarea[name=edit_compainDesc]").val(response.data.compainDesc);
                        $("#edit_is_active").val(response.data.is_active)
                        if (response.data.compainLogo != null) {
                            //$("input[name=compainLogo]").css('display','none');
                            var ImgURL = "{!!  url( '/public/uploads/CompainLogo') !!}/" + response.data.compainLogo;
                            $("#compainLogoThumb").attr('src', ImgURL);
                        }
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function(isConfirm) {
                if (isConfirm.value === true) {
                    $('#dataTable_processing').show();
                    $.ajax({
                        url: '{{ url("/admin/masjid-compain/delete") }}' + '/' + id,
                        type: 'GET',
                        success: function() {
                            $('#dataTable_processing').hide();
                            swal(
                                'Deleted!',
                                'Comapin has been deleted successfully.',
                                'success'
                            ).then(function() {

                                window.location.href = '{{ url("/admin/insurance-company-management") }}';
                            });
                        }
                    });
                }
            })
        });
    </script>
    @stop