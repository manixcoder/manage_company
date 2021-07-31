@extends('users.master')
@section('pageTitle', 'Profile Setting')
@section('pageCss')
@stop
@section('content')
<?php
 //dd($userData);
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Profile</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
    <!-- <div>
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div> -->
</div>

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
                    <center class="m-t-30"> <img src="{{ asset('public/assets/admin/images/users/profile-photo.jpg') }}" class="img-circle" width="150" />
                        <h4 class="card-title m-t-10">{{ $userData->firstName }} {{ $userData->lastName }}</h4>
                        <h6 class="card-subtitle"></h6>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <small class="text-muted">Email address </small>
                    <h6>{{ $userData->email }}</h6>
                    <small class="text-muted p-t-30 db">Phone</small>
                    <h6>{{ $userData->phone }}</h6>
                    </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="settings" role="tabpanel">
                        <div class="card-body">
                        
                            <form class="form-horizontal form-material" method="Post" action="{{ url('/user/profile-edit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group  @error('firstName') has-danger @enderror">
                                    <label class="col-md-12">First Name</label>
                                    <div class="col-md-12">
                                        <input 
                                            type="text" 
                                            placeholder="Full Name" 
                                            name="firstName" 
                                            class="form-control @error('firstName') form-control-danger @enderror "  
                                            value="{{ $errors->has('firstName') ? old('firstName') : $userData['firstName'] }}"
                                        >
                                    </div>
                                    @if ($errors->has('firstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group  @error('lastName') has-danger @enderror">
                                    <label class="col-md-12">Last Name</label>
                                    <div class="col-md-12">
                                        <input 
                                            type="text" 
                                            placeholder="Full Name" 
                                            name="lastName" 
                                            class="form-control @error('lastName') form-control-danger @enderror "  
                                            value="{{ $errors->has('lastName') ? old('lastName') : $userData['lastName'] }}"
                                        >
                                    </div>
                                    @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group  @error('email') has-danger @enderror">
                                    <label for="email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input 
                                            type="email" 
                                            placeholder="User Email"
                                            class="form-control @error('email') form-control-danger @enderror "  
                                            name="email" 
                                            readonly
                                            id="email" 
                                            value="{{ $errors->has('email') ? old('email') : $userData['email'] }}"
                                        >
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                 <div class="form-group  @error('phone') has-danger @enderror">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input 
                                            type="text" 
                                            placeholder="123 456 7890" 
                                            name="phone" 
                                            class="form-control @error('phone') form-control-danger @enderror "  
                                            value="{{ $errors->has('phone') ? old('phone') : $userData['phone'] }}" 
                                        />
                                    </div>
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                               <div class="form-group  @error('info') has-danger @enderror">
                                    <label class="col-md-12">About Info</label>
                                    <div class="col-md-12">
                                        <textarea 
                                            rows="5" 
                                            placeholder="About" 
                                            name="info" 
                                            class="form-control @error('info') form-control-danger @enderror ">{{ $errors->has('info') ? old('info') : $userData['info'] }}
                                        </textarea>
                                    </div>
                                    @if ($errors->has('info'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('info') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                                <div class="col-md-12">
								<div class="form-group @error('addressCountry') has-danger @enderror">
									<label>Driver License Country</label>
									<select class="form-control @error('addressCountry') form-control-danger @enderror" id="addressCountry" placeholder="addressCountry" name="addressCountry" onChange="getCountyLicenseClass(this);">
										<option value="">Select Driver License Country</option>
										@foreach($country as $cont)
											<option value="{{$cont->id}}" {{ ( $cont->id == $userData->addressCountry) ? 'selected' : '' }}>{{$cont->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
                            <div class="col-md-12">
								<div class="form-group @error('driver_license_class') has-danger @enderror">
								<label>Driver License Country</label>
                                
                                    <?php
                                        $driver_license_class = explode(",",$userData->driver_license_class);
                                    ?>
									<select multiple class="form-control @error('driver_license_class') form-control-danger @enderror" id="driver_license_class" placeholder="driver_license_class" name="driver_license_class[]">
										@foreach($licenseClass as $class)
											<option value="{{$class->id}}" <?php if(in_array($class->id, $driver_license_class)){ echo "selected='selected'"; } ?>>{{$class->license_class}}</option>
										@endforeach
									</select>
								</div>
							</div>

                            <div class="col-md-12">
								<div class="form-group  @error('addressLine') has-danger @enderror ">
									<label class="control-label">Address</label>
									<textarea 
                                    class="form-control   @error('addressLine') form-control-danger @enderror  " 
                                    id="addressLine" 
                                    name="addressLine">{{ old('addressLine',(isset($userData) && !empty($userData->addressLine)) ? $userData->addressLine : '' ) }}</textarea>
									@error('addressLine')
									<small class="form-control-feedback">{{ $errors->first('addressLine') }}</small>
									@enderror
								</div>
							</div>

                            <div class="col-md-12">
								<div class="form-group  @error('driver_license_id') has-danger @enderror ">
									<label class="control-label">Driver License ID</label>
									<input 
                                    type="text" 
                                    class="form-control @error('driver_license_id') form-control-danger @enderror " 
                                    id="driver_license_id" name="driver_license_id" 
                                    placeholder="Driver License ID" value="{{ old('driver_license_id',(isset($userData) && !empty($userData->driver_license_id)) ? $userData->driver_license_id : '' ) }}" 
                                    />
									@error('driver_license_id')
									<small class="form-control-feedback">{{ $errors->first('driver_license_id') }}</small>
									@enderror
								</div>
							</div>

                            <div class="col-md-12">
								<div class="form-group  @error('driver_license_expiry') has-danger @enderror ">
									<label class="control-label">Driver License Expiry</label>
									<input 
                                    type="date" 
                                    class="form-control @error('driver_license_expiry') form-control-danger @enderror " 
                                    id="driver_license_expiry" 
                                    name="driver_license_expiry" 
                                    placeholder="dd/mm/yyyy" 
                                    value="{{ old('driver_license_expiry',(isset($userData) && !empty($userData->driver_license_expiry)) ? $userData->driver_license_expiry : '' ) }}" />
									@error('driver_license_expiry')
									<small class="form-control-feedback">{{ $errors->first('driver_license_expiry') }}</small>
									@enderror
								</div>
							</div>
                            <div class="col-md-12">
								<div class="form-group  @error('ontrac_username') has-danger @enderror ">
									<label class="control-label">Ontrac Username</label>
									<input 
                                        type="text" 
                                        class="form-control @error('ontrac_username') form-control-danger @enderror " 
                                        id="ontrac_username" 
                                        name="ontrac_username" 
                                        placeholder="Ontrac Username" 
                                        value="{{ old('ontrac_username',(isset($userData) && !empty($userData->ontrac_username)) ? $userData->ontrac_username : '' ) }}" 
                                    />
									@error('ontrac_username')
									<small class="form-control-feedback">{{ $errors->first('ontrac_username') }}</small>
									@enderror
								</div>
							</div>

                            <div class="col-md-12">
								<div class="form-group  @error('ontrac_password') has-danger @enderror ">
									<label class="control-label">Ontrac Password</label>
									<input 
                                        type="text" 
                                        class="form-control @error('ontrac_password') form-control-danger @enderror " 
                                        id="ontrac_password" 
                                        name="ontrac_password" 
                                        placeholder="ontrac_password" 
                                        value="{{ old('ontrac_password',(isset($userData) && !empty($userData->ontrac_password)) ? \Crypt::decrypt($userData->ontrac_password) : '' ) }}" 
                                    />
									@error('ontrac_password')
									<small class="form-control-feedback">{{ $errors->first('ontrac_password') }}</small>
									@enderror
								</div>
							</div>
                            
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
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
</script>
@stop
