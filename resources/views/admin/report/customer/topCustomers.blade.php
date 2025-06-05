@extends('admin.layout.master')
@section('title', 'Khách hàng')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Khách hàng hàng đầu
                        <div class="page-title-subheading">
                            Danh sách khách hàng có tổng giá trị đơn hàng cao nhất.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                        <form method="GET" action="{{ route('admin.topCustomers') }}">
                            <div class="input-group">
                                <input type="search" name="search" id="search" value="{{ request('search') }}"
                                       placeholder="Tìm kiếm" class="form-control">

                                <!-- Giữ lại giá trị timeFrame khi tìm kiếm -->
                                <input type="hidden" name="timeFrame" value="{{ request('timeFrame', 'day') }}">

                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Tìm kiếm
                                    </button>
                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <a href="{{ route('admin.topCustomers.export', ['timeFrame' => request('timeFrame', 'day'), 'search' => request('search')]) }}"
                               class="btn btn-success">
                                <i class="fa fa-file-excel"></i> Xuất Excel
                            </a>
                            <div role="group" class="btn-group-sm btn-group">
                                <a href="{{ route('admin.topCustomers', ['timeFrame' => 'day']) }}" class="btn btn-focus {{ request('timeFrame', 'day') == 'day' ? 'active' : '' }}">Hôm nay</a>
                                <a href="{{ route('admin.topCustomers', ['timeFrame' => 'week']) }}" class="btn btn-focus {{ request('timeFrame') == 'week' ? 'active' : '' }}">Tuần này</a>
                                <a href="{{ route('admin.topCustomers', ['timeFrame' => 'month']) }}" class="btn btn-focus {{ request('timeFrame') == 'month' ? 'active' : '' }}">Tháng này</a>
                                <a href="{{ route('admin.topCustomers', ['timeFrame' => 'year']) }}" class="btn btn-focus {{ request('timeFrame') == 'year' ? 'active' : '' }}">Năm nay</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Tên</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Tổng chi tiêu</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td class="text-center text-muted">#{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td class="text-center">{{ $customer->email }}</td>
                                    <td class="text-center">{{ number_format($customer->total_spent, 2) }}đ</td>
                                    <td class="text-center">
                                        <a href="./admin/user/{{$customer->id}}"
                                           class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Xem chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
