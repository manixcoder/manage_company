@extends('users.master')
@section('pageTitle','Create New Driver')
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

<?php
 //dd($trackerData);
 //dd($permissionData);
?>
@stop
<div class="row">
<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white">Grant Access</h4>
			</div>
			<div class="card-body">
				@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
							<i class="ti-user"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
				@endif
				<form class="edit-form" method="POST" action="{{ url('/user/driver-management/save-driver') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-body">
						<div class="row p-t-20">
							<div class="col-md-6">
								<div class="form-group  @error('first_name') has-danger @enderror ">
									<label class="control-label">First Name</label>
									<input 
									type="text" 
									class="form-control @error('firstName') form-control-danger @enderror " 
									id="first_name" 
									name="first_name" 
									placeholder="First Name" 
									value="{{ old('first_name') }}" />
									@error('first_name')
									<small class="form-control-feedback">{{ $errors->first('first_name') }}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group  @error('middle_name') has-danger @enderror ">
									<label class="control-label">Middle Name</label>
									<input 
									type="text" 
									class="form-control @error('middle_name') form-control-danger @enderror " 
									id="middle_name" 
									name="middle_name" 
									placeholder="last Name" 
									value="{{ old('middle_name') }}" />
									@error('middle_name')
									<small class="form-control-feedback">{{ $errors->first('middle_name') }}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group  @error('last_name') has-danger @enderror ">
									<label class="control-label">Last Name</label>
									<input 
									type="text" 
									class="form-control @error('last_name') form-control-danger @enderror " 
									id="last_name" 
									name="last_name" 
									placeholder="last Name" 
									value="{{ old('last_name') }}" />
									@error('last_name')
									<small class="form-control-feedback">{{ $errors->first('last_name') }}</small>
									@enderror
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group  @error('email') has-danger @enderror ">
									<label class="control-label">Email </label>
									<input type="email" class="form-control @error('email') form-control-danger @enderror " id="email" name="email" placeholder="User Email" value="{{ old('email') }}" />
									@error('email')
									<small class="form-control-feedback">{{ $errors->first('email') }}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group  @error('phone') has-danger @enderror ">
									<label class="control-label">Phone </label>
									<input type="text" class="form-control @error('phone') form-control-danger @enderror " id="phone" name="phone" placeholder="phone" value="{{ old('phone') }}" />
									@error('phone')
									<small class="form-control-feedback">{{ $errors->first('phone') }}</small>
									@enderror
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group  @error('address') has-danger @enderror ">
									<label class="control-label">Address</label>
									<textarea class="form-control   @error('address') form-control-danger @enderror  " id="address" placeholder="Address" name="address"  >{{ old('address') }}</textarea>
									@error('address')
									<small class="form-control-feedback">{{ $errors->first('address') }}</small>
									@enderror
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group  @error('driver_license_number') has-danger @enderror ">
									<label class="control-label">Driver License ID</label>
									<input 
									type="text" 
									class="form-control @error('driver_license_number') form-control-danger @enderror " 
									id="driver_license_number" 
									name="driver_license_number" 
									placeholder="Driver License ID" 
									value="{{ old('driver_license_number') }}" />
									@error('driver_license_number')
									<small class="form-control-feedback">{{ $errors->first('driver_license_number') }}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group @error('driver_license_class') has-danger @enderror">
									<label>Driver License Country</label>
									<select multiple  class="form-control @error('driver_license_class') form-control-danger @enderror" id="driver_license_class" placeholder="driver_license_class" name="driver_license_class[]">
									<option value=""> --Select Class-- </option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group  @error('driver_license_valid_till') has-danger @enderror ">
									<label class="control-label">Driver License Valid Till</label>
									<input 
									type="date" 
									class="form-control @error('driver_license_valid_till') form-control-danger @enderror " 
									id="driver_license_valid_till" 
									name="driver_license_valid_till" 
									placeholder="dd/mm/yyyy" 
									value="{{ old('driver_license_valid_till') }}" 
									data-dtp="dtp_MHyIp" />
									@error('driver_license_valid_till')
									<small class="form-control-feedback">{{ $errors->first('driver_license_valid_till') }}</small>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group  @error('personnel_number') has-danger @enderror ">
									<label class="control-label">National ID</label>
									<input 
									type="text" 
									class="form-control @error('personnel_number') form-control-danger @enderror " 
									id="personnel_number" 
									name="personnel_number" 
									placeholder="National ID" 
									value="{{ old('personnel_number') }}" />
									@error('personnel_number')
									<small class="form-control-feedback">{{ $errors->first('personnel_number') }}</small>
									@enderror
								</div>
							</div>
                            
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-info waves-effect waves-light  cus-submit save-btn"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@stop
@section('pagejs')
<script type="text/javascript">
</script>

@stop