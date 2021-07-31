@extends('users.master')
@section('pageTitle','Create New Driver')
@section('content')
@section('pageCss')
<style>
</style>
<?php 
// foreach($trackerData['list'] as $list){
// 	dd($list['label']);
// }
?>
@stop
<div class="row">
<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white">Add New Driver</h4>
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
							<!-- <div class="col-md-6">
								<div class="form-group  @error('name') has-danger @enderror ">
									<label class="control-label">User Name</label>
									<input type="text" class="form-control @error('name') form-control-danger @enderror " id="name" name="name" placeholder="User Name" value="{{ old('name') }}" />
									@error('name')
									<small class="form-control-feedback">{{ $errors->first('name') }}</small>
									@enderror
								</div>
							</div> -->
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
								<div class="form-group @error('addressCountry') has-danger @enderror">
									<label>Driver License Country</label>
									<select class="form-control @error('addressCountry') form-control-danger @enderror" id="addressCountry" placeholder="addressCountry" name="addressCountry" onChange="getCountyLicenseClass(this);">
										<option value="">Select Driver License Country</option>
										@foreach($country as $cont)
											<option value="{{$cont->id}}" >{{$cont->name}}</option>
										@endforeach
									</select>
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
							

							<div class="col-md-6">
								<div class="form-group @error('tracker_id') has-danger @enderror">
									<label>Assets</label>
									<select class="form-control @error('tracker_id') form-control-danger @enderror" id="tracker_id" placeholder="tracker_id" name="tracker_id">
										<option value="nullTracker">Select Assets</option>
										@foreach($trackerData['list'] as $list)
										<option value="{{$list['id']}}">{{$list['label']}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<input type="hidden" name="lacationaddress"/>
							<input type="hidden" name="lat"  />
							<input type="hidden" name="log"  />

							
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
	function getCountyLicenseClass(obj){
		let countryId = $(obj).val();
		$.ajax({
			url:'{{ url("/request/get-country-license-class") }}'+'/'+countryId,
			type: 'GET',
			success:function(rtnData){
				 console.log(rtnData);
				 if(rtnData.status == 'success'){
					 var classList	=	rtnData.list;
					 let options = "<option value=''> --Select Options-- </option>";
					 $.each(classList,function(key, value){
						 options +='<option value=' + value.license_class + '>' + value.license_class + '</option>';
					});
					$('#driver_license_class').html(options);
					}else{
						console.log(rtnData.msg);
					}
				}
		}); 
	}
	
	
	$("#address").on("change",function(){
		var address = $(this).val();
		$.ajax({
			url:'{{ url("/user/driver-management/get-country-name") }}'+'/'+address,
			type: 'GET',
			success:function(rtnData){
				// console.log(rtnData.data);
				$('input[name=lacationaddress]').val(rtnData.apidata.locations[0]['address']);
				$('input[name=lat]').val(rtnData.apidata.locations[0]['lat']);
				$('input[name=log]').val(rtnData.apidata.locations[0]['lng']);
				
				var countryId = rtnData.data[0]['id'];
				$.ajax({
					 url:'{{ url("/request/get-country-license-class") }}'+'/'+countryId,
					 type: 'GET',
					 success:function(rtnData){

						 console.log(rtnData);
						 if(rtnData.status == 'success'){
							 $("#addressCountry").val(countryId);
							 var classList	=	rtnData.list;
							 let options = "<option value=''> --Select Options-- </option>";
							 $.each(classList,function(key, value){
								 options +='<option value=' + value.license_class + '>' + value.license_class + '</option>';
							});
							$('#driver_license_class').html(options);
							}else{
								console.log(rtnData.msg);
							}
				}
		});
				//  if(rtnData.status == 'success'){
				// 	 var classList	=	rtnData.list;
				// 	 let options = "<option value=''> --Select Options-- </option>";
				// 	 $.each(classList,function(key, value){
				// 		 options +='<option value=' + value.license_class + '>' + value.license_class + '</option>';
				// 	});
				// 	$('#driver_license_class').html(options);
				// 	}else{
				// 		console.log(rtnData.msg);
				// 	}
				}
		});

	});
</script>

@stop