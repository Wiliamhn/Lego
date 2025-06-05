@extends('front.layout.master')
@section('title','Chi tiết đơn hàng')
@section('body')

    <div class="breacrumb-section" style="margin-top: 100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Chi tiết đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="checkout-section spad">
        <div class="container">
            <form action="" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="#" class="content-btn">
                                Mã đơn hàng
                                <b>#{{$order->id}}</b>
                            </a>
                        </div>
                        <h4></h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">Họ tên<span>*</span></label>
                                <input type="text" id="fir" value="{{$order->first_name}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Tên<span>*</span></label>
                                <input type="text" id="last" value="{{$order->last_name}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun-name">Tên Giao Dịch Của Công Ty</label>
                                <input type="text" id="cun-name" value="{{$order->company_name}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Quốc gia<span>*</span></label>
                                <input type="text" id="cun" value="{{$order->country}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Địa chỉ<span>*</span></label>
                                <input type="text" id="street" class="street-first" value="{{$order->street_address}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Mã bưu chính / ZIP (tùy chọn)</label>
                                <input type="text" id="zip" value="{{$order->postcode_zip}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Thị trấn / Thành phố<span>*</span></label>
                                <input type="text" id="town" value="{{$order->town_city}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email<span>*</span></label>
                                <input type="text" id="email" value="{{$order->email}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Điện thoại<span>*</span></label>
                                <input type="text" id="phone" value="{{$order->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href="#" class="content-btn">
                                Trạng thái
                                <b>{{\App\Utilities\Constant::$order_status[$order->status]}}</b>
                            </a>
                        </div>
                        <div class="place-order">
                            <h4>Đơn hàng</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Sản phẩm <span>Tổng tiền</span></li>
                                    @foreach($order->orderDetails as $orderDetail)
                                    <li class="fw-normal">
                                        {{$orderDetail->product->name}} x {{$orderDetail->qty}}
                                        <span>{{ number_format($orderDetail->total, 0, ',', '.') }}đ</span>
                                    </li>
                                    @endforeach
                                    <li class="total-price">
                                        Tổng tiền
                                        <span>{{ number_format(array_sum(array_column($order->orderDetails->toArray(), 'total')), 0, ',', '.') }}đ</span>
                                    </li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Thanh toán khi nhận hàng
                                            <input disabled type="radio" name="payment_type" value="pay_later" id="pc-check"
                                                {{$order->payment_type == 'pay_later' ? 'checked' : ''}}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Thanh toán online
                                            <input disabled type="radio" name="payment_type" value="online_payment" id="pc-paypal"
                                                {{$order->payment_type == 'online_payment' ? 'checked' : ''}}>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
