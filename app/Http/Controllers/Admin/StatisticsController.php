<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Exports\RevenueProfitExport;
use Maatwebsite\Excel\Facades\Excel;
class StatisticsController extends Controller
{
    public function index()
    {
        return view('admin.statistics.index');
    }

    public function getRevenueProfitData(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return response()->json(['error' => 'Start date and end date are required.'], 400);
        }

        try {
            $startDate = Carbon::parse($start)->startOfDay();
            $endDate = Carbon::parse($end)->endOfDay();

            $data = DB::table('order_details')
                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                ->whereIn('orders.status', [1, 4]) // ✅ Lấy cả status = 1 và 4
                ->whereBetween('orders.created_at', [$startDate, $endDate])
                ->selectRaw("
    DATE_FORMAT(CONVERT_TZ(orders.created_at, '+00:00', '+07:00'), '%Y-%m-%d') as time,
    SUM(order_details.total) as revenue
")

                ->groupBy('time')
                ->orderBy('time')
                ->get();



            $data = $data->map(function ($item) {
    $item->revenue = $item->revenue ?? 0;
    return $item;
});


            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Statistics Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch statistics.'], 500);
        }
    }
    public function exportExcel(Request $request)
{
    $start = $request->input('start_date');
    $end = $request->input('end_date');

    if (!$start || !$end) {
        return redirect()->back()->with('error', 'Please select start and end date.');
    }

    $startDate = Carbon::parse($start)->startOfDay();
    $endDate = Carbon::parse($end)->endOfDay();

    $data = DB::table('order_details')
        ->join('orders', 'orders.id', '=', 'order_details.order_id')
        ->whereIn('orders.status', [1, 4])
        ->whereBetween('orders.created_at', [$startDate, $endDate])
        ->selectRaw("
            DATE_FORMAT(CONVERT_TZ(orders.created_at, '+00:00', '+07:00'), '%Y-%m-%d') as time,
            SUM(order_details.total) as revenue
        ")
        ->groupBy('time')
        ->orderBy('time')
        ->get()
        ->map(function ($item) {
            $item->revenue = $item->revenue ?? 0;
            return $item;
        });

    return Excel::download(new RevenueProfitExport($data), 'revenue_' . now()->format('Ymd_His') . '.xlsx');
}

}
