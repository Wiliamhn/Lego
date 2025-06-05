@extends('front.layout.master')

@section('title','Home')
@section('body')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1" style="background-image: url(front/images/slide-01.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-101 cl2 respon2" style="color: #d1ecf1">
                                Những phi thuyền chiến đấu
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1" style="color: #d1ecf1">
                                Lego star war
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Xem ngay
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1" style="background-image: url(front/images/slide-02.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                            <span class="ltext-101 cl2 respon2" style="color: #d1ecf1">
                                Những mini figure giới hạn
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1" style="color: #d1ecf1">
                                Vệ binh giải ngân hà
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                            <a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Xem ngay
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item-slick1" style="background-image: url(front/images/slide-03.jpg);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                            <span class="ltext-101 cl2 respon2" style="color: #d1ecf1">
                                Mô hình xe dã ngoại
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1" style="color:#d1ecf1">
                                Lego Cars
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                            <a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Xem ngay
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="front1/img/banner-01.jpg" alt="IMG-BANNER" style="width: 400px">

                    <a href="/shop/brand/Lego Ninjago" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Ninjago
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                Mùa hè 2025
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Xem ngay
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="front1/img/banner-02.jpg" alt="IMG-BANNER" style="width:400px">

                    <a href="/shop/brand/Lego Ideals" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Lego Ideals
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                Sáng tạo
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Xem ngay
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="front1/img/banner-03.jpg" alt="IMG-BANNER" style="width: 400px">

                    <a href="shop/category/Gundam" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Siêu anh hùng
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                Mùa mới
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Xem ngay
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Women Banner Section Begin -->
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="front1/img/products/ninjago.jpg">

                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="filter-control">
                    <ul>
                        <li class="active item" data-tag="*" data-category="lego">Tất cả</li>
                        <li class="item" data-tag=".ninjago" data-category="lego">Lego Ninjago</li>
                        <li class="item" data-tag=".technic" data-category="lego">Lego Technic</li>
                        <li class="item" data-tag=".batman" data-category="lego">Lego Batman</li>

                    </ul>
                </div>
                <div class="product-slider lego owl-carousel">
                    @foreach($featuredProducts['lego'] as $product)
                    <div class="product-item item {{ Str::slug($product->tag) }}">

                        <div class="pi-pic">
                            <img src="front1/img/products/{{$product->productImages[0]->path}}" alt="" style="height: 200px">
                            @if($product->discount != null)
                            <div class="sale">Giảm giá</div>
                            @endif

                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                @if($product->qty > 0)
                                <li class="w-icon active"><a style="background:rgb(79, 229, 19)" href="javascript:addCart({{$product->id}})"><i class="icon_bag_alt"></i></a></li>
                                @else
                                <div class="sale" style="background:rgb(248, 252, 21);">Hết hàng</div>

                                @endif

                                <li class="quick-view"><a href="shop/product/{{$product->id}}">+ Xem ngay</a></li>
                                <li class="w-icon">
                                    <a href="#" onclick="copyToClipboard('{{ Request::url() }}'); return false;" title="Sao chép liên kết">
                                        <i class="fa fa-random"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$product->tag}}</div>
                            <a href="shop/product/{{$product->id}}">
                                <h5>{{$product->name}}</h5>
                            </a>
                            <div class="product-price">
                                <div class="product-price">
                                    @if($product->discount != null)
                                    {{ number_format($product->discount, 0, ',', '.') }} đ
                                    <span>{{ number_format($product->price, 0, ',', '.') }} đ</span>
                                    @else
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->
<!-- Man Banner Section Begin -->
<!-- Man Banner Section Begin -->
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="filter-control">
                    <ul>
                        <li class="active item" data-tag="*" data-category="gundam">Tất cả</li>
                        <li class="item" data-tag=".bandai" data-category="gundam">Bandai</li>
                        <li class="item" data-tag=".moshow-toy" data-category="gundam">Moshow toy</li>
                        <li class="item" data-tag=".motor-nuclear" data-category="gundam">Motor nuclear</li>

                    </ul>
                </div>
                <div class="product-slider owl-carousel gundam">
                    @foreach($featuredProducts['gundam'] as $product)
                    <div class="product-item item {{ Str::slug($product->tag) }}">
                        <div class="pi-pic">
                            <img src="front1/img/products/{{$product->productImages[0]->path}}" alt="" style="height: 200px">
                            @if($product->discount != null)
                            <div class="sale">Giảm giá</div>
                            @endif
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                @if($product->qty > 0)
                                <li class="w-icon active"><a style="background: rgb(79, 229, 19)" href="javascript:addCart({{$product->id}})"><i class="icon_bag_alt"></i></a></li>
                                @else
                                <div class="sale" style="background:rgb(248, 252, 21);">Hết hàng</div>

                                @endif

                                <li class="quick-view"><a href="shop/product/{{$product->id}}">+ Xem ngay</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$product->tag}}</div>
                            <a href="shop/product/{{$product->id}}">
                                <h5>{{$product->name}}</h5>
                            </a>
                            <div class="product-price">
                                <div class="product-price">
                                    @if($product->discount != null)
                                    {{ number_format($product->discount, 0, ',', '.') }} đ
                                    <span>{{ number_format($product->price, 0, ',', '.') }} đ</span>
                                    @else
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="front1/img/products/cars.jpg">

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Man Banner Section End -->


<!-- Latest Blog Section Begin -->
<section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Tin tức sản phẩm mới</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="front1/img/blog/{{$blog->image}}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                {{ date('d/m/Y', strtotime($blog->created_at)) }}
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                {{count($blog->blogComments)}}
                            </div>
                        </div>
                        <a href="#">
                            <h4>{{$blog->title}}</h4>
                        </a>
                        <p>{{$blog->subtitle}} </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-1.png" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Miễn phí vận chuyển</h6>
                            <p>Cho mọi đơn hàng trên 1 triệu</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-2.png" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Giao hàng đúng giờ</h6>
                            <p>Nếu hàng gặp sự cố</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-1.png" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Thanh toán an toàn</h6>
                            <p>Thanh toán an toàn 100%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
function copyToClipboard(text) {
    const temp = document.createElement("textarea");
    temp.value = text;
    document.body.appendChild(temp);
    temp.select();
    document.execCommand("copy");
    document.body.removeChild(temp);
    alert("Đã sao chép liên kết: " + text);
}
</script>

<!-- Latest Blog Section End -->

@endsection