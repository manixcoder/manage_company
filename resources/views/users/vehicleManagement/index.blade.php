@extends('users.master')
@section('pageTitle','Vehicle Management')
@section('content')
<?php
//dd($driverData['list']);
?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <div class="right-side-struct pull-right" >
               <a href="{{ url('/user/assets-management/create') }}" @if(! Session::has('hash')) data-toggle="modal" data-target="#loginModal" @endif class="btn btn-info waves-effect waves-light clearfix add-new add-faicon"  ><i class="fa fa-plus" aria-hidden="true"></i> Add New vehicle </a>
            </div>
            <h4 class="card-title">All Vehicle Listing</h4>
            <h6 class="card-subtitle">Here you can manage vehicle</h6>
            <div class="table-responsive m-t-40">
               @if(Session::has('status'))
               <div class="alert alert-{{ Session::get('status') }}">
                  <i class="ti-user"></i> {{ Session::get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
               </div>
               @endif
               <table id="dataTable" class="table table-striped table-bordered dataTable">
                  <thead>
                     <tr>
                        <th>label</th>
                        <th>model Name</th>
                        <th>Fuel Type</th>
                        <th>Type</th>
                        <th>Reg Number</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <th>label</th>
                        <th>model Name</th>
                        <th>Fuel Type</th>
                        <th>Type</th>
                        <th>Reg Number</th>
                        <th>Action</th>
                     </tr>
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
           { data : "label" },
           { data: 'model' },
           { data : "fuel_type" },
           { data: 'type' },
           // { data: 'subtype' },
           { data: 'reg_number'},
           {
               /* this is Actions Column  */
               mRender: function (data, type, row) {
                   var editButton = '<a href="<?php echo url('user/assets-management'); ?>/' + row.id + '/edit" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>';
                   var deleteButton = '<a href="javascript:void(0);"  data-id="'+ row.id  +'" data-toggle="tooltip" data-original-title="Delete" class="delete"> <i class="fa fa-close text-danger"></i> </a>';
                   return editButton + " " + deleteButton ;
               }
           }
       ],
       ajax: {
           url: '{!! url("/user/assets-management/driver-data") !!}',
           dataSrc: 'list',
           error: function(err) {
               $('.dataTables_processing').hide();
               console.log(err.responseJSON.status.description);
               // alert(  err.responseJSON.status.description );
           }
       },
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
                       url:'{{ url("/user/assets-management/delete") }}'+'/'+id,
                       type: 'GET',
                       success:function(){
                           $('#dataTable_processing').hide();
                           swal(
                               'Deleted!',
                               'Your Driver has been deleted successfully.',
                               'success'
                               ).then(function(){
                                   window.location.href = '{{ url("/user/assets-management") }}';
                               });
                       }
                   });
               }
           })
   });
</script>
@stop