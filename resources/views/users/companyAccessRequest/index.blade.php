@extends('users.master')
@section('pageTitle','Access Request Management')
@section('content')
@section('pageCss')
<style>
#permissionModal .form-group {
    width: 50%;
    float: left;
}
#permissionModal .modal-footer {
    width: 100%;
    float: left;
}


</style>
@stop
<?php
// foreach ($trackerData as $key => $tracker) {
//     dd($tracker);
// }
//dd($trackerData);
//dd($permissionData);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title"> <i class="mdi mdi-view-list"></i> All Access Request Listing</h4>
                <h6 class="card-subtitle">Here you can manage access</h6>
                <div class="table-responsive m-t-40">
                @if(Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }}">
                <i class="fa fa-building-o" aria-hidden="true"></i> {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                    @endif
                    <table id="dataTable" class=" table table-striped table-bordered dataTable  ">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Trackers Name</th>
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


<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-main-title">Access Permission</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/user/access-request-management/acceptRequest') }}" >
                {{ csrf_field() }}
                        <div class="form-group">
                            <label>Please select Permission</label>
                                <div class="input-group">
                                <input type="hidden" name="requestUserId" value=""/>
                                    <ul class="icheck-list" id="tracker_id">
                                    
                                    
                                   
                                   
                                   
                                    </ul>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
                    
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->
@stop
@section('pagejs')
<script type="text/javascript">
    $(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [10, 50, 100],
            order: [
                [1, 'desc']
            ],
            ajax: '{!! url("/user/access-request-management/request-data") !!}',
            columns: [{
                    data: 'name',
                    name: 'name',
                    orderable: true
                },
                {
                    data: 'reg_number',
                    name: 'reg_number',
                    orderable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
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
                "sEmptyTable": "No data available in table",
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

    });
    $(document).on("click", ".request_access", function(){
        var id = $(this).attr("data-id");
        // alert(id);
         $("input[name=requestUserId]").val(id);
         $(".request_permission").attr("data-id",id);
        $.ajax({
            url: '{{ url("/user/access-request-management/getRequestedData") }}' + '/' + id,
            type: 'GET',
            success: function(data) {
                $('#tracker_id').html(data.content);
                }
            });
    });

    $(document).on("click", ".request_permission", function(){
        var id = $(this).attr("data-id");
        var tr_id =$(this).attr("data-tr_id");
        $.ajax({
            url: '{{ url("/user/access-request-management/getRequestedTrackerData") }}' + '/' + id+'/'+tr_id,
            type: 'GET',
            success: function(data) {
                $('#permission_id_div').append(data.content);
                }
            });
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
                        url: '{{ url("/user/insurance-company-management/delete") }}' + '/' + id,
                        type: 'GET',
                        success: function() {
                            $('#dataTable_processing').hide();
                            swal(
                                'Deleted!',
                                'Company has been deleted successfully.',
                                'success'
                                ).then(function() {
                                    window.location.href = '{{ url("/user/insurance-company-management") }}';
                        });
                    }
                });
            }
        })
    });
</script>
@stop
