@extends('admin.layout')

@section('content')
    <div class="container">
        <h1>Báo cáo Thống kê Bán hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Tổng Đơn Hàng</th>
                    <th>Tổng Doanh Thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->date }}</td>
                        <td>{{ $order->total_orders }}</td>
                        <td>{{ number_format($order->total_sales, 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection