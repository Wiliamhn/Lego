<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // Giả định bạn có model Order

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Điều chỉnh truy vấn dựa trên các cột thực tế
        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total_orders, SUM(amount) as total_sales')
                       ->groupBy('date')
                       ->get();

        return view('admin.report.index', compact('orders'));
    }
}