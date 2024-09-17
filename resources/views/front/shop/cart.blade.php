
@extends('front.layout.master')
@section('title','Cart')
@section('body')




<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            @if(Cart::count()>0)
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <thead>
                            <tr class="table_head">
                                <th class="column-1">Sản phẩm</th>
                                <th class="column-2"></th>
                                <th class="column-3">Giá</th>
                                <th class="column-4">Số lượng</th>
                                <th class="column-5">Thành tiền
                                <th class="column-5"><i style="cursor: pointer" onclick="confirm('Bạn muốn xóa hết toàn bộ ?') === true ? destroyCart() : ''"  class="ti-close"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)

                            <tr class="table_row" data-rowId="{{$cart->rowId}}">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="front1/img/products/{{$cart->options->images[0]->path}}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{$cart->name}}</td>
                                <td class="column-3">${{number_format($cart->price, 2)}}</td>
                                <td class="column-4">
                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="changeQuantity('{{ $cart->rowId }}', 'decrease')">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="text" name="num-product1" value="{{ $cart->qty }}" data-rowid="{{ $cart->rowId }}" readonly>

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="changeQuantity('{{ $cart->rowId }}', 'increase')">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                    </div>
                                </td>
                                <td class="column-5">${{number_format($cart->price * $cart->qty, 2)}}</td>
                                <td><i style="cursor: pointer" onclick="removeCart('{{$cart->rowId}}')" class="ti-close"></i></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>




                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Apply coupon
                            </div>
                        </div>

                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            Update Cart
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <h4 style="margin-top: 20px;">Không có sản phẩm nào</h4>
                </div>
            @endif

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
                        </div>

                        <div class="size-209">
								<span class="mtext-110 cl2">
									${{$subtotal}}
								</span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
                        </div>

                        <div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									${{$total}}
								</span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                       <a style="color: whitesmoke" href="./checkout">Thanh toán</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
