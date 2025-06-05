@extends('front.layout.master')
@section('title','Product')
@section('body')


	<!-- Product -->
    <br><br />
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                        Ninjago
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
						Men
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
						Bag
					</button>


				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
						<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
						<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						 Filter
					</div>

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
                        <form action="shop">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
                        </form>
						<input class="mtext-107 cl2 size-114 plh2 p-r-15" value="{{request('search')}}" type="text" name="search" placeholder="Search">
					</div>
				</div>

				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Lựa chọn
							</div>
                            <div class="select-option">
                                <select name="sort_by" onchange="handleChange(this);" class="sorting">
                                    <option {{ request('sort_by') == 'latest' ? 'selected' : '' }} value="latest">Mới nhất</option>
                                    <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">Cũ nhất</option>
                                    <option {{ request('sort_by') == 'name-ascending' ? 'selected' : '' }} value="name-ascending">Từ A-Z</option>
                                    <option {{ request('sort_by') == 'name-descending' ? 'selected' : '' }} value="name-descending">Từ Z-A</option>
                                    <option {{ request('sort_by') == 'price-ascending' ? 'selected' : '' }} value="price-ascending">Giá tăng dần</option>
                                    <option {{ request('sort_by') == 'price-descending' ? 'selected' : '' }} value="price-descending">Đắt nhất</option>
                                </select>

                            </div>
						</div>

						<div class="filter-col2 p-r-15 p-b-27">
                            <div class="filter-widget">
                                <h4 class="fw-title">Danh mục</h4>
                                <ul class="filter-catagories">
                                    @foreach($categories as $category)
                                   <li><a href="shop/category/{{$category->name}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
						</div>



						<div class="filter-col4 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Tags
							</div>

							<div class="flex-w p-t-4 m-r--5">
								@foreach($products as $product)
								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									{{$product->tag}}
								</a>
                                    @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row isotope-grid">
                @foreach($products as $product)
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->product_category_id}}">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="front1/img/products/{{$product->productImages[0]->path}}" alt="IMG-PRODUCT" style="height: 200px">

							<a href="shop/product/{{$product->id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
								Xem ngay
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="shop/product/{{$product->id}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$product->name}}
								</a>

								<span class="stext-105 cl3">
									${{$product->price}}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="front/images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="front/images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
                @endforeach

			</div>

		{{$products->links()}}
		</div>
	</div>
    <script>
        function handleChange(select) {
            const selectedValue = select.value;
            const currentUrl = window.location.href;
            const baseUrl = currentUrl.split('?')[0];
            window.location.href = `${baseUrl}?sort_by=${selectedValue}`;
        }
    </script>

@endsection
