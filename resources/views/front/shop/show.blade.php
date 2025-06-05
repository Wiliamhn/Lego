@extends('front.layout.master')
@section('title','Product')
@section('body')
<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row" style="margin: 0px auto; position:relative">

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="front1/img/products/{{$product->productImages[0]->path}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                @foreach($product->productImages as $productImage)
                                <div class="pt active" data-imgbigurl="front1/img/products/{{$productImage->path}}">
                                    <img src="front1/img/products/{{$productImage->path}}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" style="margin-left:70%; position:absolute">
                        <div class="product-details">
                            <div class="pd-title">

                                <h3>{{$product->name}}</h3>
                                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                            </div>
                            <div class="pd-rating">
                                @for($i=1; $i<=5; $i++)
                                    @if($i <=$product->avgRating)
                                    <i class="fa fa-star"></i>
                                    @else
                                    <i class="fa fa-star-o"></i>
                                    @endif
                                    @endfor
                                    <span>({{ count($product->productComments) }})</span>
                            </div>
                            <div class="pd-desc">
                                @if($product->discount != null)
                                <h4>
                                    {{ number_format($product->discount, 0, ',', '.') }} đ
                                    <span style="text-decoration: line-through; color: gray; font-size: 0.9em; margin-left: 8px;">
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </span>
                                </h4>
                                @else
                                <h4>{{ number_format($product->price, 0, ',', '.') }} đ</h4>
                                @endif

                            </div>
                            <p>{{$product->content}}</p>
                            <div class="quantity">
                                
                                @if($product->qty > 0)
                                <a href="javascript:addCart({{$product->id}})" class="primary-btn pd-cart" style="width: auto">Giỏ hàng</a>
                                @else
                                <a class="primary-btn pd-cart disabled" style="width: auto; background-color: grey; cursor: not-allowed">Hết hàng</a>
                                @endif
                            </div>
                            <ul class="pd-tags">
                                <li><span>Hãng</span>: {{$product->productCategory->name}}</li>
                                <li><span>Thể loại</span>: {{$product->tag}}</li>
                            </ul>
                            <div class="pd-share">
                                <div class="p-code">Mã hàng hóa : {{$product->sku}}</div>
                                <div class="pd-social">
                                    <a href="#"><i class="ti-facebook"></i></a>
                                    <a href="#"><i class="ti-twitter-alt"></i></a>
                                    <a href="#"><i class="ti-linkedin"></i></a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="product-tab" style="width:1000px; margin-top:100px;  position:relative;margin-left:100px">
                    <div class="tab-item" style="margin-left:200px">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#tab-1" role="tab">Giới thiệu</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" role="tab">Thông tin</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3" role="tab">Bình luận ({{ count($product->productComments) }})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-item-content">
                        <div class="tab-content">
                            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                <div class="product-content">
                                    {!! $product->description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                <div class="specification-table">
                                    <table>
                                        <tr>
                                            <td class="p-catagory">Customer Rating</td>
                                            <td>
                                                <div class="pd-rating">
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($i <=$product->avgRating)
                                                        <i class="fa fa-star"></i>
                                                        @else
                                                        <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @endfor
                                                        <span>({{ count($product->productComments) }})</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Giá</td>
                                            <td>
                                                <div class="p-price">{{$product->price}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Thêm vào giỏ hàng</td>
                                            <td>
                                                <div class="cart-add">+ add to cart</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Của hàng còn</td>
                                            <td>
                                                <div class="p-stock">{{$product->qty}} sản phẩm</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Mã hàng hóa</td>
                                            <td>
                                                <div class="p-code">{{$product->sku}}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="customer-review-option">
                                    <h4>{{count($product->productComments)}} Bình luận</h4>
                                    <div class="comment-option">
                                        @foreach($product->productComments as $productComment)
                                        <div class="co-item">
                                            <div class="avatar-pic">
                                                <img src="front1/img/user/{{$productComment->user->avatar ??'default-avatar.jpg'}}" alt="">
                                            </div>
                                            <div class="avatar-text">
                                                <div class="at-rating">
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($i <=$productComment->rating)
                                                        <i class="fa fa-star"></i>
                                                        @else
                                                        <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @endfor
                                                </div>
                                                <h5>{{$productComment->name}} <span>{{date('M d, Y',strtotime($productComment->created_at))}}</span></h5>
                                                <div class="at-reply">
                                                    <p>{{$productComment->messages}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="leave-comment">
                                        <h4>Để lại một bình luận</h4>
                                        <form action="" method="post" class="comment-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null}}">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Name" name="name">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Email" name="email">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Messages" name="messages"></textarea>
                                                    <div class="personal-rating">
                                                        <h6>Your Rating</h6>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="rating" value="5" />
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="rating" value="4" />
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="rating" value="3" />
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="rating" value="2" />
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="rating" value="1" />
                                                            <label for="star1" title="text">1 star</label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="site-btn">Gửi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

<!-- Related Products Section End -->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($relatedProducts as $product)
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="front1/img/products/{{$product->productImages[0]->path}}" alt="">
                        @if($product->discount != null)
                        <div class="sale">Sale</div>
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
<!-- Related Products Section End -->
@endsection