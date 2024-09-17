@extends('front.layout.master')
@section('title','Đơn hàng của bạn')
@section('body')

    <div class="breacrumb-section" style="margin-top: 100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Đơn hàng của bạn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th>Hình ảnh
                                <th>Mã đơn</th>

                                <th style="margin-left: 30px" class="p-name">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="cart-pic first-row"><img style="width: 100px;margin-left: 60px" src="front1/img/products/{{$order->orderDetails[0]->product->productImages[0]->path}}" alt=""></td>
                                <td class="first-row">#{{$order->id}}</td>
                                <td class="cart-title first-row">
                                    <h5>{{$order->orderDetails[0]->product->name}}
                                        @if(count($order->orderDetails) > 1)
                                        (và {{count($order->orderDetails)}} sản phẩm khác)
                                        @endif
                                    </h5>
                                </td>
                                <td class="p-title first-row">
                                    ${{array_sum(array_column($order->orderDetails->toArray(), 'total'))}}
                                </td>
                                <td class="first-row">
                                    <a class="btn" href="./account/my-order/{{$order->id }}" >Chi tiết</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
