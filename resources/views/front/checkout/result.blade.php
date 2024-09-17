@extends('front.layout.master')
@section('title','Result')
@section('body')

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 style="margin-top: 50px">
                        {{$notification}}
                    </h4>

                    <a href="./" class="primary-btn mt-5">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
