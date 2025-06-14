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
                    <span>Đăng nhập</span>
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
                    <h2>Đăng nhập</h2>
                    @if(session('notification'))
                    <div class="alert alert-warning" role="alert">
                        {{session('notification')}}
                    </div>
                    @endif
                    <form action="" method="post">
                        @csrf
                        <div class="group-input">
                            <label for="email">Email đăng nhập</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="group-input">
                            <label for="pass">Mật khẩu *</label>
                            <input type="password" id="pass" name="password">
                        </div>
                        <div class="group-input gi-check">
                            <div class="gi-more">
                                <label for="save-pass">
                                    Lưu mật khẩu
                                    <input type="checkbox" id="save-pass" name="remember">
                                    <span class="checkmark"></span>
                                </label>
                                <a href="{{ route('password.forgot') }}" class="forget-pass">Quên mật khẩu</a>
                            </div>
                        </div>
                        <button style="background: #e51313" type="submit" class="site-btn login-btn">Đăng nhập</button>

                    </form>
                    <a href="{{ route('redirect.google') }}" class="btn btn-danger btn-block mt-3" >
                        <i class="fab fa-google" style="float:left;margin-top:4px"></i> Đăng nhập bằng google
                    </a>
                    <a href="{{ route('redirect.google') }}" class="btn btn-danger btn-block mt-3"  style="background-color:#0866ff">
                        <i class="fab fa-facebook" style="float:left;margin-top:4px"></i> Đăng nhập bằng facebook
                    </a>
                    <div class="switch-login">
                        <a href="./account/register" class="or-login">Tạo tài khoản mới</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

@endsection