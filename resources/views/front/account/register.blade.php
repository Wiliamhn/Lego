@extends('front.layout.master')
@section('title','Đăng nhập')
@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section" style="margin-top: 100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Đăng kí tài khoản</span>
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
                    <div class="register-form">
                        <h2>Đăng kí</h2>
                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{session('notification')}}
                            </div>
                        @endif
                        <form action="" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="name">Tên tài khoản</label>
                                <input type="text" id="name" name="name">
                            </div>
                            <div class="group-input">
                                <label for="email">Nhập email</label>
                                <input type="email" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Mật khẩu *</label>
                                <input type="password" id="pass" name="password">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Nhập lại mật khẩu *</label>
                                <input type="password" id="con-pass" name="password_confirmation">
                            </div>
                            <button style="background: #e51313" type="submit" class="site-btn register-btn">Đăng kí</button>
                        </form>
                        <div class="switch-login">
                            <a href="./account/login" class="or-login">Đã có tài khoản</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection
