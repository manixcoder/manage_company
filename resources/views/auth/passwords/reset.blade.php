@extends('layouts.auth')
@section('content')
 
<div class="login-register" style="background-image:url({{ asset('public/assets/admin/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal form-material" method="POST" id="loginform" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <h3 class="box-title m-b-20">{{ __('Reset Password') }}</h3>
                <div class="form-group ">
                    <div class="col-xs-12">

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" style="display:block !important" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                    </div>
                </div>



                <div class="form-group ">
                    <div class="col-xs-12">

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" style="display:block !important" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>


                <div class="form-group ">
                    <div class="col-xs-12">

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
 
                    </div>
                </div>



                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"> {{ __('Reset Password') }}</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
   

@endsection
