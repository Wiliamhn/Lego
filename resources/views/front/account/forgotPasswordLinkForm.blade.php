@extends('front.layout.master')

@section('title', 'Reset Password')

@section('body')

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Login</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Reset Password</h2>


                    @if(session('notification'))
                    <div class="alert alert-warning" role="alert">
                        {{session('notification')}}
                    </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


                    <form action="{{route('password.forgot.link.submit')}}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="group-input">
                            <label for="email">Email address *</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input type="password" id="pass" name="password" name="remember">
                        </div>
                        <div class="group-input">
                            <label for="password_confirmation">Confirm Password *</label>
                            <input type="password" id="pass" name="password_confirmation">
                        </div>
                        <button type="submit" class="site-btn login-btn">Reset Password</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
