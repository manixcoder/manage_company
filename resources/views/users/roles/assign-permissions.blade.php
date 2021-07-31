@extends('admin.master')
@section('title', 'Assign Permissions')
@section('content')

@section('pageCss')

<style>
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}

	.switch input {
		display: none;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: red;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked+.slider {
		background-color: #28a745;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked+.slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>

@stop

<div class="cus-inner">
	<div class="panel-group">
		<div class="panel panel-default admin-assign-permission">
			<div class="panel-heading">Assigned Permissions to <b>{{ $roleDate->display_name }}</b></div>
			<div class="panel-body">
				@if(Session::has('status'))
				<div class="alert alert-{{ Session::get('status') }} clearfix">{{ Session::get('message') }}</div>
				@endif
				<div class="full-form">
					<form class="edit-form" id="permission_form" method="POST" action="{{ url('/admin/role-management/save-role-permission') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="role_id" value="{{$roleDate->id}}" />
						<div class="row assign-permission">
							<div class="col-md-12">
								<div class="form-group">
									<h5>List of Permissions</h5>
								</div>
							</div>

							@foreach ($permissions as $sel_permissions)
							<div class="col-md-12">
								<div class="form-group">
									<div class="cus-permissions">
										<label class="permission_name">{{$sel_permissions->display_name}}</label>
										@if(\App\Role::hasCustomPermission($roleDate->id,$sel_permissions->id) == true)
										<label class="switch">
											<input id="chkbox" type="checkbox" checked name="permission_id[]" value="{{$sel_permissions->id}}" />
											<span class="slider round"></span>
										</label>
										<!--label><input id="chkbox" type="checkbox" checked name="permission_id[]" value="{{$sel_permissions->id}}" />	</label-->
										@else
										<label class="switch">
											<input id="chkbox" type="checkbox" name="permission_id[]" value="{{$sel_permissions->id}}" />
											<span class="slider round"></span>
										</label>
										<!--label><input id="chkbox" type="checkbox" name="permission_id[]" value="{{$sel_permissions->id}}" />	{{$sel_permissions->display_name}}</label--->
										@endif
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="frms-buttons">
							<div class="col-md-12 pl-0">
								<button type="submit" class="btn btn-primary btn-success form-control add-faicon save-btn"><i class="fa fa-save" aria-hidden="true"></i>Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop