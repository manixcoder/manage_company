@extends('admin.master')
@section('pageTitle','Permission Management')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="right-side-struct pull-right">
            <a href="" class="btn btn-info waves-effect waves-light clearfix add-new add-faicon" data-toggle="modal"
                data-target="#permissionModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New Permission</a>
        </div>
    </div>
    <div class="col-12">
 
        @foreach($roles as $key2 => $role)
		 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo  $role['name'] ?> </h4>
				 
                <div class="row">
                    @foreach($permission as $key => $single)
                    <?php // dd($single);?>
					 
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label class="inline custom-control custom-checkbox block">
							<input 
								type="checkbox" 
								value="{{ $single->id }}"
								class="custom-control-input permissionsId"
								data-roleId="{{ $role['id'] }}"
								data-permissionId="{{ $single->id }}"
								name="permissions"
								id="permissionsId"
								<?php if(array_search($single->id, array_column($role['AllPermissions'], 'permission_id')) !== false) { echo "checked"; } ?>
							/>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description ml-0">{{ $single->name }}  
								</span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div id="permissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Permission</h4>
            </div>
            <div class="modal-body">
                <form id="permissionForm">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Display Name</label>
                        <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Enter Display Name">
                        <small class="error form-control-feedback" id="error-name"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                        <small class="error form-control-feedback" id="error-name"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Role</label>
                        <select name="role[]" multiple>
                            @foreach($roles as $role)
                            <option value="{{ $role['id'] }}">{{ $role['display_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default submit_permission">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
    @section('pagejs')
    <script type="text/javascript">
			$(document).ready(function () {
				$('.permissionsId').on('change', function() {
					var roleId = $(this).attr("data-roleId");
					var permissionId = $(this).attr("data-permissionId");					
					//var ch = $("input[type='checkbox']").val();
                     //alert("roleId "+roleId);
                     //alert("permissionId "+permissionId);
				 
					var newForm = { roleId : roleId ,  permissionId: permissionId, "_token": "{{ csrf_token() }}" };		
					$.ajax({
						'url': "{!!  url( '/admin/management-permissions/change-permission') !!}",
						'method': 'post',
						'dataType': 'json',
						'data': newForm,
						 
						success: function (data) {
							if (data.status == 'success') {
								 console.log(data.status);
							} else if (data.status == 'exception' || data.status == 'danger') {
								swal("Error", data.message, "error");
							} else {
								swal("Action failed", "Please fill required fields", "error");
								$('.error').html('');
								$('.error').parent().removeClass('has-danger');
								$.each(data, function (key, value) {
									 if (value != "") {
										 $("#error-" + key).text(value);
										 $("#error-" + key).parent().addClass('has-danger');
										}
								});
							}
						}
					});
					
				});
			});

        $(document).on('submit', '#permissionForm', function () {
            $.ajax({
                'url': "{!!  url( '/admin/management-permissions/save-permission') !!}",
                'method': 'post',
                'dataType': 'json',
                'data': $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        swal("Success", data.message, "success").then(function () {
                            window.location.href ="{!! url( '/admin/management-permissions') !!}"
                        });
                    } else if (data.status == 'exception' || data.status == 'danger') {
                        swal("Error", data.message, "error");
                    } else {
                        swal("Action failed", "Please fill required fields", "error");
                        $('.error').html('');
                        $('.error').parent().removeClass('has-danger');
                        $.each(data, function (key, value) {
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
		</script>
    @stop
