@extends('admin.master')
@section('pageTitle','Email Tempalte Management')

@section('content')
     
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"> <i class="mdi mdi-view-list"></i>  All Email Listing</h4>
				<h6 class="card-subtitle">Here you can manage Email Tempates</h6>
				<div class="table-responsive m-t-40">
					@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
                            <i class="fa fa-envelope" aria-hidden="true"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					@endif

					<div class="right-side-struct">
				 	   <a href="{{ url('/admin/email-management/create') }}" class="btn btn-info waves-effect waves-light clearfix add-new add-faicon"  ><i class="fa fa-plus" aria-hidden="true"></i> Add New Template</a>
					</div>

					<table id="dataTable" class=" table table-striped table-bordered dataTable  ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Created Date</th>
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
$(function() {

    $('#dataTable').DataTable({
        processing : true,
        serverSide: true,
        lengthMenu: [10,20,50,100],
        order: [[1,'Asc']],
        ajax: '{!! url("/admin/email-management/template-data") !!}',
        columns: [
		
			{ data: 'name',		name: 'name',   orderable: true },
			{ data: 'subject',  name: 'subject',  orderable: true },
            { data: 'status',	name: 'status', orderable: true, render: function ( data, type, row ){
				if(row.status ==  'Active'  ){ 
					var status = 'success'; var text = row.status; 
				}else{
					var status = 'danger';  var text = row.status;
				}
				    return '<span class="label label-'+status+'"> '+text+' </span>';
                } 
            },
            { data: 'created_at',	name: 'created_at',	orderable: true, "visible":true },
            { data: 'action', name: 'action', orderable: false,  },
        ],
       
        dom: 'Blfrptip',
        buttons: [
                {
                     extend: 'colvis',text: "Show / Hide Columns"
                }
        ], 
        oLanguage: {
                sProcessing: "<img height='80' width='80' src='{{ url('public/assets/admin/images/loading.gif') }}' alt='loader'/>",
				"oPaginate": {
					"sPrevious": "Previous", // This is the link to the previous page
					"sNext": "Next",
				},
				"sSearch": "Search",
				"sLengthMenu": "Show _MENU_ entries",
				"sInfo": "Showing _START_ to _END_ of _TOTAL_ enteris",
				"sInfoEmpty" : "Showing 0 to 0 of 0 entries",
				 "sInfoFiltered": "search filtered entries",
				"sZeroRecords": "No matching records found",
				"sEmptyTable": "No data available in table",
        },
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
	});

});
 
$(document).on('click','.delete',function(){

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

        }).then(function (isConfirm) {

            if (isConfirm.value === true) {

				$('#dataTable_processing').show();
                
                $.ajax({
                    url:'{{ url("/admin/email-management/delete") }}'+'/'+id,
                    type: 'GET',
                    success:function(){
						$('#dataTable_processing').hide();
                        swal(
                            'Deleted!',
                            'Your agent has been deleted successfully.',
                            'success'
                        ).then(function(){
                            window.location.href = '{{ url("/admin/email-management") }}';
                        });
                    }
                });  
            }
        })
});
</script>
@stop
