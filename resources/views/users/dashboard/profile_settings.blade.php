@extends('users.master')
@section('pageTitle', 'Profile')

@section('content')

<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab" aria-expanded="true">Settings</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="settings" role="tabpanel" aria-expanded="true">
                    <div class="card-body">
                        @if(Session::has('status'))
                        <div class="alert alert-{{ Session::get('status') }}">
                            <i class="ti-user"></i> {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        @endif
                        <form class="form-horizontal form-material" action="{{ url('admin/profile-edit') }}" method="POST">
                            @csrf
                            <div class="form-group @error('name') has-danger is-invalid  @enderror ">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" placeholder="Your Name" class="form-control form-control-line  @error('name') form-control-danger @enderror  " value="{{ $errors->has('name') ? old('name') : Auth::user()->name }}" />
                                    @error('name')
                                    <small class="form-control-feedback">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group  @error('email') has-danger @enderror ">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" placeholder="User Email" class="form-control form-control-line @error('email') form-control-danger @enderror " id="email" value="{{ $errors->has('email') ? old('email') : Auth::user()->email }}" disabled />
                                    @error('email')
                                    <small class="form-control-feedback">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<!-- Row -->
@endsection