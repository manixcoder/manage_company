@extends('layouts.auth')
@section('content')
<div class="login-register" style="background-image:url({{ asset('public/assets/admin/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-body">
            @if(Session::has('status'))
            <div class="alert alert-{{ Session::get('status') }}">
                 {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            @endif
            <form class="form-horizontal form-material" method="POST" id="loginform" action="{{ route('login') }}">
                @csrf
                <h3 class="box-title m-b-20">Sign In</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" required="" name="email" placeholder="User Email" value="{{ old('email') }}" required autocomplete="email" autofocus> </div>
                    @error('email')
                    <span class="invalid-feedback" style="display:block !important" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required="" placeholder="Password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" style="display:block !important" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 font-14">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link text-dark pull-right" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection