@extends('admin.master')
@section('pageTitle',' Company Management')
@section('content')
@section('pageCss')
<style></style>
@stop
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">

            <div class="card-body">
                @if(Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }}">
                    <i class="ti-user"></i> {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                @endif
                <form class="edit-form" method="POST" action="{{ url('/admin/employee-management/save-employee') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row p-t-20">
						<div class="col-md-6">
                                <div class="form-group  @error('name') has-danger @enderror ">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control @error('firstName') form-control-danger @enderror " id="firstName" name="firstName" placeholder="first Name" value="{{ old('firstName') }}" />
                                    @error('firstName')
                                    <small class="form-control-feedback">{{ $errors->first('firstName') }}</small>
                                    @enderror
                                </div>
                            </div>

							<div class="col-md-6">
                                <div class="form-group  @error('lastName') has-danger @enderror ">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control @error('lastName') form-control-danger @enderror " id="lastName" name="lastName" placeholder="lastName" value="{{ old('lastName') }}" />
                                    @error('lastName')
                                    <small class="form-control-feedback">{{ $errors->first('lastName') }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group  @error('name') has-danger @enderror ">
                                    <label class="control-label">User Name</label>
                                    <input type="text" class="form-control @error('name') form-control-danger @enderror " id="name" name="name" placeholder="Company Name" value="{{ old('name') }}" />
                                    @error('name')
                                    <small class="form-control-feedback">{{ $errors->first('name') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  @error('email') has-danger @enderror ">
                                    <label class="control-label">Email </label>
                                    <input type="text" class="form-control @error('email') form-control-danger @enderror" id="email" name="email" placeholder="Company Email" value="{{ old('email') }}" />
                                    @error('email')
                                    <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  @error('password') has-danger @enderror ">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control @error('password') form-control-danger @enderror " id="password" name="password" placeholder="Company password" value="{{ old('password') }}" />
                                    @error('password')
                                    <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                                    @enderror
                                </div>
                            </div>

							<div class="col-md-6">
                                <div class="form-group  @error('name') has-danger @enderror ">
                                    <label class="control-label">Phone</label>
                                    <input type="number" class="form-control @error('phone') form-control-danger @enderror " id="phone" name="phone" placeholder="phone" value="{{ old('phone') }}" />
                                    @error('phone')
                                    <small class="form-control-feedback">{{ $errors->first('phone') }}</small>
                                    @enderror
                                </div>
                            </div>

							<div class="col-md-6">
                                <div class="form-group  @error('name') has-danger @enderror ">
                                    <label class="control-label">Salary</label>
                                    <input type="number" class="form-control @error('salary') form-control-danger @enderror " id="salary" name="salary" placeholder="salary" value="{{ old('salary') }}" />
                                    @error('salary')
                                    <small class="form-control-feedback">{{ $errors->first('salary') }}</small>
                                    @enderror
                                </div>
                            </div>

							<div class="col-md-6">
								<div class="form-group @error('company_id') has-danger @enderror">
									<label>Company</label>
									<select class="form-control @error('company_id') form-control-danger @enderror" id="company_id" placeholder="company_id" name="company_id">
										<option value="">Select  Company</option>
										@foreach($company as $comp)
										<option value="{{$comp->id}}">{{$comp->name}}</option>
										@endforeach
									</select>
								</div>
							</div>

                            


                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-info waves-effect waves-light  cus-submit save-btn"><i class="fa fa-save" aria-hidden="true"></i> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@stop

