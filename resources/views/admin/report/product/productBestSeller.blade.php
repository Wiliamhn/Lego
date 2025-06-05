@extends('admin.layout.master')
@section('title', 'Sản phẩm bán chạy')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Sản phẩm bán chạy
                        <div class="page-title-subheading">
                            Xem, tạo, cập nhật, xóa và quản lý các sản phẩm bán chạy nhất.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" value="{{ request('search') }}"
                                       placeholder="Tìm kiếm..." class="form-control">
                                <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp;
                                    Tìm kiếm
                                </button>
                            </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <a href="{{ route('admin.report.exportBestSellingProducts', ['timeFrame' => $timeFrame, 'search' => request('search')]) }}"
                               class="btn-shadow btn-hover-shine mr-3 btn btn-success">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-file-excel fa-w-20"></i>
                                </span>
                                Xuất Excel
                            </a>
                            <div role="group" class="btn-group-sm btn-group">
                                <a href="{{ route('admin.report.product.productBestSeller', ['timeFrame' => 'day']) }}" class="btn btn-focus {{ $timeFrame == 'day' ? 'active' : '' }}">Hôm nay</a>
                                <a href="{{ route('admin.report.product.productBestSeller', ['timeFrame' => 'week']) }}" class="btn btn-focus {{ $timeFrame == 'week' ? 'active' : '' }}">Tuần này</a>
                                <a href="{{ route('admin.report.product.productBestSeller', ['timeFrame' => 'month']) }}" class="btn btn-focus {{ $timeFrame == 'month' ? 'active' : '' }}">Tháng này</a>
                                <a href="{{ route('admin.report.product.productBestSeller', ['timeFrame' => 'year']) }}" class="btn btn-focus {{ $timeFrame == 'year' ? 'active' : '' }}">Năm nay</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Mã sản phẩm</th>
                                <th>Tên / Thương hiệu</th>
                                <th class="text-center">Số lượng đã bán</th>
                                <th class="text-center">Tổng doanh thu</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center text-muted">#{{ $product->id }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;" data-toggle="tooltip" title="Hình ảnh" data-placement="bottom"
                                                             src="{{ asset('front1/img/products/' . $product->image_path) }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $product->name }}</div>
                                                    <div class="widget-subheading opacity-7">
                                                        {{ $product->brand_name ?? 'Không có thương hiệu' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $product->total_quantity }}</td>
                                    <td class="text-center">{{ number_format($product->total_revenue, 2) }}đ</td>
                                    <td class="text-center">
                                        <a href="./admin/product/{{ $product->id }}" class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
