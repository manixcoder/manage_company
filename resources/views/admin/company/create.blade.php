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
                <form class="edit-form" method="POST" action="{{ url('/admin/company-management/save-company') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group  @error('name') has-danger @enderror ">
                                    <label class="control-label">Company Name</label>
                                    <input type="text" class="form-control @error('name') form-control-danger @enderror " id="name" name="name" placeholder="Company Name" value="{{ old('name') }}" />
                                    @error('name')
                                    <small class="form-control-feedback">{{ $errors->first('name') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  @error('email') has-danger @enderror ">
                                    <label class="control-label">Company Email </label>
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
                                <div class="form-group  @error('logo') has-danger @enderror ">
                                    <label class="control-label">Logo</label>
                                    <input type="file" class="form-control @error('logo') form-control-danger @enderror " id="logo" name="logo" />
                                    @error('logo')
                                    <small class="form-control-feedback">{{ $errors->first('logo') }}</small>
                                    @enderror
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