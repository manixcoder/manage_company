@extends('users.master')
@section('pageTitle','Edit User')
@section('content')
@section('pageCss')
<style></style>
@stop
<div class="row">
	<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white">Edit User : {{ (isset($user) && !empty($user->name)) ? $user->name : '' }} </h4>
			</div>
			<div class="card-body">
					@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
							<i class="ti-user"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					@endif
					<form class="edit-form" method="POST" action="{{ url('/admin/user-management/'.Crypt::encrypt($user->id).'/update') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-body"> 
							<div class="row p-t-20">
								
								<div class="col-md-6">
									<div class="form-group  @error('firstName') has-danger @enderror ">
										<label class="control-label">First Name</label>
										<input 
											type="text" 
											class="form-control @error('firstName') form-control-danger @enderror " 
											id="firstName" 
											name="firstName"
											placeholder="First Name"
											value="{{ old('firstName',(isset($user) && !empty($user->firstName)) ? $user->firstName : '' ) }}"
										/>
										@error('firstName')
											<small class="form-control-feedback">{{ $errors->first('firstName') }}</small>
										@enderror
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group  @error('lastName') has-danger @enderror ">
										<label class="control-label">Last Name</label>
										<input 
											type="text" 
											class="form-control @error('lastName') form-control-danger @enderror " 
											id="lastName" 
											name="lastName"
											placeholder="Last Name"
											value="{{ old('lastName',(isset($user) && !empty($user->lastName)) ? $user->lastName : '' ) }}"
										/>
										@error('lastName')
											<small class="form-control-feedback">{{ $errors->first('lastName') }}</small>
										@enderror
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group  @error('name') has-danger @enderror ">
										<label class="control-label">User Name</label>
										<input 
											type="text" 
											class="form-control @error('name') form-control-danger @enderror " 
											id="name" 
											name="name" 
											value="{{ old('name',(isset($user) && !empty($user->name)) ? $user->name : '' ) }}"
										/>
										@error('name')
											<small class="form-control-feedback">{{ $errors->first('name') }}</small>
										@enderror
									</div>
								</div>	

								<div class="col-md-6">
									<div class="form-group  @error('email') has-danger @enderror ">
										<label class="control-label">Email </label>
										<input 
											type="email"
											class="form-control @error('email') form-control-danger @enderror " 
											id="email" 
											name="email" 
											value="{{ old('email',(isset($user) && !empty($user->email)) ? $user->email : '' ) }}"
											readonly
											disabled
										/>
										@error('email')
											<small class="form-control-feedback">{{ $errors->first('email') }}</small>
										@enderror
									</div>
								</div>

								
								 
								<div class="col-md-6">
									<div class="form-group  @error('phone') has-danger @enderror ">
										<label class="control-label">Phone </label>
										<input 
											type="text"
											class="form-control @error('phone') form-control-danger @enderror " 
											id="phone" 
											name="phone" 
											value="{{ old('phone',(isset($user) && !empty($user->phone)) ? $user->phone : '' ) }}"
										/>
										@error('phone')
											<small class="form-control-feedback">{{ $errors->first('phone') }}</small>
										@enderror
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group  @error('is_active') has-danger @enderror ">
										<label class="control-label">Status</label>
										<div class="m-b-30">
                                            <input 
												type="checkbox"
												class="js-switch" 
												data-color="#0ca302" 
												data-secondary-color="#f62d51" 
												data-size="large" 
												<?php echo  $user->is_active == '1'  ? 'checked' : '' ;  ?>
												name="is_active"
												/>
											</div>
										@error('is_active')
											<small class="form-control-feedback">{{ $errors->first('is_active') }}</small>
										@enderror
									</div>
								</div>
								 
								<div class="col-md-12">
									<div class="form-group  @error('info') has-danger @enderror ">
										<label class="control-label">Notes</label>
										<textarea
											class="form-control   @error('info') form-control-danger @enderror  "
											id="info"
											name="info"
										>{{ old('info',(isset($user) && !empty($user->info)) ? $user->info : '' ) }}</textarea>

										@error('info')
											<small class="form-control-feedback">{{ $errors->first('info') }}</small>
										@enderror
									</div>
								</div>

							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-info waves-effect waves-light  cus-submit save-btn"><i class="fa fa-upload" aria-hidden="true"></i> Update</button>
						</div>

					</form>
				</div>
	      	</div>
	    </div>
    </div>
</div>

@stop

