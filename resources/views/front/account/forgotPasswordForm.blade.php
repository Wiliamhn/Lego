@extends('front.layout.master')

@section('title', 'Forgot Password')

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
                    <h2>Login</h2>


                    @if(session('notification'))
                    <div class="alert alert-warning" role="alert">
                        {{session('notification')}}
                    </div>
                    @endif


                    <form action="{{route('password.forgot.post')}}" method="post">
                        @csrf
                        <div class="group-input">
                            <label for="email">Email address *</label>
                            <input type="email" id="email" name="email">
                        </div>

                        <button type="submit" class="site-btn login-btn">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
