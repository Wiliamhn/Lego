@extends('admin.layout.master')
@section('title', 'Sản phẩm được xem nhiều nhất')
@section('body')

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Sản phẩm được xem nhiều nhất
                    <div class="page-title-subheading">
                        Thống kê lượt xem của các sản phẩm được xem nhiều nhất.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <div class="btn-actions-pane-right">
                        <a href="{{ route('admin.report.exportTopViewedProducts', ['time_frame' => request('time_frame')]) }}"
                           class="btn-shadow btn-hover-shine mr-3 btn btn-success">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-file-excel fa-w-20"></i>
                            </span>
                            Xuất Excel
                        </a>
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ route('admin.report.product.topViewedProducts', ['time_frame' => 'day']) }}"
                               class="btn btn-focus {{ request('time_frame') == 'day' ? 'active' : '' }}">
                                Hôm nay
                            </a>
                            <a href="{{ route('admin.report.product.topViewedProducts', ['time_frame' => 'week']) }}"
                               class="btn btn-focus {{ request('time_frame') == 'week' ? 'active' : '' }}">
                                Tuần này
                            </a>
                            <a href="{{ route('admin.report.product.topViewedProducts', ['time_frame' => 'month']) }}"
                               class="btn btn-focus {{ request('time_frame') == 'month' ? 'active' : '' }}">
                                Tháng này
                            </a>
                            <a href="{{ route('admin.report.product.topViewedProducts', ['time_frame' => 'year']) }}"
                               class="btn btn-focus {{ request('time_frame') == 'year' ? 'active' : '' }}">
                                Năm nay
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Lượt xem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topViewedProducts as $product)
                            <tr>
                                <td class="text-center">#{{ $product->id }}</td>
                                <td>{{ $product->product->name }}</td>
                                <td class="text-center">{{ $product->views_count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-block card-footer">
                    {{ $topViewedProducts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
