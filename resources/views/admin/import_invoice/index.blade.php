@extends('admin.layout.master')
@section('title', 'Hóa Đơn Nhập')
@section('body')

<!-- Main -->
<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Hóa Đơn Nhập
                    <div class="page-title-subheading">
                        Xem, tạo, cập nhật, xóa và quản lý các hóa đơn nhập.
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="{{ url('admin/import-invoice/create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Tạo Mới
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <form method="GET" action="{{ url('admin/import-invoice') }}" class="d-flex">
                        <div class="input-group">
                            <input type="search" name="search" id="search" value="{{ request('search') }}" placeholder="Mã hóa đơn..." class="form-control">
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="">Tất cả nhà cung cấp</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp; Tìm kiếm
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="btn-actions-pane-right">
                        <a href="{{ route('importInvoice.export', ['timeFrame' => request('timeFrame', 'day'), 'supplier_id' => request('supplier_id'), 'search' => request('search')]) }}" class="btn btn-success">
                            <i class="fa fa-file-excel"></i> Xuất Excel
                        </a>
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ url('admin/import-invoice?timeFrame=day&search=' . request('search') . '&supplier_id=' . request('supplier_id')) }}" class="btn btn-focus {{ request('timeFrame', 'day') == 'day' ? 'active' : '' }}">Hôm nay</a>
                            <a href="{{ url('admin/import-invoice?timeFrame=week&search=' . request('search') . '&supplier_id=' . request('supplier_id')) }}" class="btn btn-focus {{ request('timeFrame') == 'week' ? 'active' : '' }}">Tuần này</a>
                            <a href="{{ url('admin/import-invoice?timeFrame=month&search=' . request('search') . '&supplier_id=' . request('supplier_id')) }}" class="btn btn-focus {{ request('timeFrame') == 'month' ? 'active' : '' }}">Tháng này</a>
                            <a href="{{ url('admin/import-invoice?timeFrame=year&search=' . request('search') . '&supplier_id=' . request('supplier_id')) }}" class="btn btn-focus {{ request('timeFrame') == 'year' ? 'active' : '' }}">Năm nay</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nhà Cung Cấp</th>
                                <th>Ngày Nhập</th>
                                <th>Tổng Tiền</th>
                                <th class="text-center">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td class="text-center text-muted">#{{ $invoice->id }}</td>
                                <td>{{ $invoice->supplier->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->import_date)->format('d/m/Y') }}</td>
                                <td>{{ number_format($invoice->details->sum(function($detail) 
                                    { return $detail->quantity * $detail->unit_price;}), 2) }} đ
                                </td>
                                <td class="text-center">
                                    <a href="./admin/import-invoice/{{$invoice->id}}"
                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                        Chi tiết
                                    </a>
                                    <a href="{{ url('admin/import-invoice/' . $invoice->id . '/edit') }}" data-toggle="tooltip" title="Chỉnh sửa" class="btn btn-outline-warning border-0 btn-sm">
                                        <i class="fa fa-edit fa-w-20"></i>
                                    </a>
                                    <form class="d-inline" action="{{ url('admin/import-invoice/' . $invoice->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này không?')"
                                            data-toggle="tooltip" title="Xóa">
                                            <i class="fa fa-trash fa-w-20"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-block card-footer">
                    {{ $invoices->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>

</div>
<!-- End Main -->
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endsection
