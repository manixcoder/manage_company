@extends('users.master')
@section('pageTitle','Driver Management')
@section('content')
<?php
//dd($driverData['list']);

?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
                <div class="right-side-struct pull-right" >
				    <a href="{{ url('/user/driver-management/create') }}" @if(! Session::has('hash')) data-toggle="modal" data-target="#loginModal" @endif class="btn btn-info waves-effect waves-light clearfix add-new add-faicon"  ><i class="fa fa-plus" aria-hidden="true"></i> Add New Driver </a>
				</div>
                <h4 class="card-title">All Driver Listing</h4>
				<h6 class="card-subtitle">Here you can manage driver</h6>
                <div class="table-responsive m-t-40">
                @if(Session::has('status'))
                    <div class="alert alert-{{ Session::get('status') }}">
                        <i class="ti-user"></i> {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
                    </div>
                @endif


                <table id="dataTable" class=" table table-striped table-bordered dataTable  ">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <!-- <th>Name</th> -->
                                <th>Email</th>
                                <th>Phone Number</th>
                                <!-- <th>Account Status</th>
                                <th>Created Date</th> -->
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


@stop
@section('pagejs')
<script type="text/javascript">
    $('#dataTable').DataTable({
        processing : true,
        lengthMenu: [10,20,50,100,1000],
        order: [[1,'desc']],
        oLanguage: {
                sProcessing: "<img height='80' width='80' src='{{ url('public/assets/admin/images/loading.gif') }}' alt='loader'/>",
        },
        columns: [
            { data : "first_name" },
            { data: 'middle_name' },
            { data : "last_name" },
            { data: 'email' },
            { data: 'phone' },
            {
                /* this is Actions Column  */
                mRender: function (data, type, row) {
                    var editButton = '<a href="<?php echo url('user/driver-management'); ?>/' + row.id + '/edit" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>';
                    var deleteButton = '<a href="javascript:void(0);"  data-id="'+ row.id  +'" data-toggle="tooltip" data-original-title="Delete" class="delete"> <i class="fa fa-close text-danger"></i> </a>';
                    return editButton + " " + deleteButton ;
                }
            }
        ],
        ajax: {
            url: '{!! url("/user/driver-management/driver-data") !!}',
            dataSrc: 'list',
            error: function(err) {
                $('.dataTables_processing').hide();
                alert(  err.responseJSON.status.description );
            }
        },
    });
$(function() {
   
});
$(document).on('click','.delete',function(){
    var id = $(this).data('id');
   
    swal({
        title: 'Are you sure ?',
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
    }).then(function (isConfirm) {
        if (isConfirm.value === true) {
            $('#dataTable_processing').show();
            $.ajax({
                url:'{{ url("/user/driver-management/delete") }}'+'/'+id,
                type: 'GET',
                success:function(){
                    $('#dataTable_processing').hide();
                    swal(
                        'Deleted!',
                        'Your Driver has been deleted successfully.',
                        'success'
                        ).then(function(){
                            window.location.href = '{{ url("/user/driver-management") }}';
                        });
                    }
                });
            }
        })
    });
</script>
@stop