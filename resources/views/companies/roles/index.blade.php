@extends('admin.master')
@section('pageTitle','Role Management')
@section('content')	      
 
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">All Roles Listing</h4>
				<h6 class="card-subtitle">Here you can manage Roles</h6>
				<div class="table-responsive m-t-40">
					@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
							<i class="ti-user"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					@endif

					<div class="right-side-struct">
				 	   <button type="button" class="btn btn-info waves-effect waves-light clearfix add-new add-faicon" data-toggle="modal" data-target="#addrole"><i class="fa fa-plus" aria-hidden="true"></i> Add New Role </button>
					</div>

					<table id="dataTable" class=" table table-striped table-bordered dataTable  ">
						<thead>
							<tr>
								<th>Role Name</th>
								<th>Roles Description</th>
								<th>Roles Action</th>
							</tr>
						</thead>
						
						<tbody>
						</tbody>

						<!--tfoot>
							<tr>
								<th></th>
								<th></th>
								<th class="remove_input"></th>
							</tr>
			        	</tfoot-->


					</table>
				</div>
			</div>
		</div>
                        
	</div>
</div>



<!-- Trigger the modal with a button -->
				<!-- Modal -->
				<div id="addrole" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
						<h4 class="modal-title"> Add Role </h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				      </div>
				      <div class="modal-body clearfix">
				        <form id="addroles">
							{{csrf_field() }}
							<br>
							 
							<div class="form-group">
			                    <label for="name" class="col-md-12 control-label"> Role Name</label>
			                    <div class="col-md-12">
			                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
									<small class="error form-control-feedback" id="error-name"></small>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="display_name" class="col-md-12 control-label"> Display Name</label>
			                    <div class="col-md-12">
			                        <input type="text" class="form-control" id="display_name" name="display_name" value="{{ old('display_name') }}">
			                        <small class=" error form-control-feedback" id="error-display_name"></small>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="description" class="col-md-12 control-label"> Description </label>
			                    <div class="col-md-12">
			                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
									<small class="error form-control-feedback" id="error-description"></small>
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
@stop
@section('pagejs')
<script type="text/javascript">

	$(function() {

		$('#dataTable').DataTable({
		   	processing : true,
		    serverSide: true,
		    ajax: '{!! url( "/admin/role-management/role-data") !!}',
		    columns: [
				
				{ data: 'display_name', name: 'display_name', orderable: true },
		    	{ data: 'description', name: 'description', orderable: true },
		        { data: 'action', name: 'action', orderable: false},
		    ],
		    
		    lengthMenu: [10,25,50,100],
		    order: [[1,'desc']],
		    oLanguage: {
		    		sProcessing: "<img height='80' width='80' src='{{ url('public/assets/admin/images/loading.gif') }}' alt='loader'/>",
					"oPaginate": {
						"sPrevious": "Previous", // This is the link to the previous page
						"sNext": "Next",
					},
					"sSearch": "Search",
					"sLengthMenu": " Show _MENU_ entries ",
					"sInfo": " Showing _START_ to _END_ of _TOTAL_ enteris ",
					"sInfoEmpty" : " Showing 0 to 0 of 0 entries ",
					"sInfoFiltered": " search filtered entries ",
					"sZeroRecords": " No matching records found ",
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
		

/* 
|----------------
|	Description	:	Code for Auto Key Slug
|	Date		:	25/June/2019
|----------------
*/		
		$("#name").keyup(function(){
			var Text = $(this).val();    
			Text = Text.toLowerCase();   
			var regExp = /\s+/g;    
			Text = Text.replace(regExp,'-');  
			$(this).val(Text);   
		}); 
	
		
		
	});

$(document).on('submit','#addroles',function(){
	
	$('#dataTable_processing').show();
	
	$.ajax({
        'url'      : "{!!  url( '/admin/role-management/save-create-role') !!}",
        'method'   : 'post',
        'dataType' : 'json',
        'data'     : $(this).serialize(),
		success    : function(data){
			
			$('#dataTable_processing').hide();
			
        	if(data.status == 'success')
        	{
        		swal( "Success", data.message, "success" ).then(function(){
        			window.location.href="{!! url( '/admin/role-management') !!}"
        		});
        		
        	}
        	else if(data.status == 'exception' || data.status == 'danger' )
        	{
        		swal("Error", data.message, "error");
        	}
			else
        	{
        		swal("Action failed", "Please fill required fields", "error");
        		$('.error').html('');
        		$('.error').parent().removeClass('has-danger');
                $.each(data,function(key,value){
                    if(value != ""){
                        $("#error-"+key).text(value);
                        $("#error-"+key).parent().addClass('has-danger');
                    }
                });
        	}
            
        }
      
  	});
	return false;
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

		if(isConfirm.value === true){
			
			$('#dataTable_processing').show();
			
			$.ajax({
				url:'{{ url("/admin/role-management/delete-role") }}'+'/'+id,
				type: 'GET',
				success:function(success){
					$('#dataTable_processing').hide();
					
					swal(
					    'Deleted!',
					    'Role has been deleted successfully.',
					    'success'
				  	).then(function(isConfirm){
				  		if(isConfirm){
				  			window.location.href = '{{ url("/admin/role-management") }}';
				  		}
				  	});
				  	
				},error:function(error){
					alert('There is an Error while Deleting Role');
				}
			}); 
		} 
	})
});

</script>
@stop
