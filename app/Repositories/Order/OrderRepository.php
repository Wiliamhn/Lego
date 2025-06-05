<?php

namespace App\Repositories\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Carbon\Carbon;
use App\Repositories\BaseRepositories;
use App\Models\OrderDetail;
class OrderRepository extends BaseRepositories implements OrderRepositoryInterface
{

    public function getModel()
    {
        return Order::class;
    }

    public function getOrderByUserId($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->get();
    }
    public function getBestSellingProducts($timeFrame)
{
    $subImage = DB::table('product_images')
        ->select('product_id', DB::raw('MIN(path) as image_path'))
        ->groupBy('product_id');

    $query = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'products.id', '=', 'order_details.product_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->leftJoinSub($subImage, 'product_images', function ($join) {
            $join->on('product_images.product_id', '=', 'products.id');
        })
        ->selectRaw('
    SUM(order_details.qty) AS total_quantity,
    products.id,
    products.name,
    brands.name AS brand_name,
    SUM(order_details.total) AS total_revenue,
    product_images.image_path
')

        ->groupBy('products.id', 'products.name', 'brands.name', 'product_images.image_path')
        ->orderByDesc('total_quantity');

    switch ($timeFrame) {
        case 'week':
            $query->where('orders.created_at', '>=', now()->subWeek());
            break;
        case 'month':
            $query->where('orders.created_at', '>=', now()->subMonth());
            break;
        case 'year':
            $query->where('orders.created_at', '>=', now()->subYear());
            break;
        default:
            $query->whereDate('orders.created_at', '=', Carbon::today()->toDateString());
    }

    return $query; // ✅ trả về Query Builder để paginate ở controller

}
public function getTopCustomersByRevenue($timeFrame, $search = null)
    {
        $query = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->selectRaw('users.id, users.name, users.email, SUM(order_details.total) as total_spent')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('total_spent');

        // Lọc theo thời gian
        switch ($timeFrame) {
            case 'week':
                $query->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('orders.created_at', now()->month);
                break;
            case 'year':
                $query->whereYear('orders.created_at', now()->year);
                break;
            default:
                $query->whereDate('orders.created_at', today());
        }

        // Nếu có tìm kiếm
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            });
        }

        // Trả về đối tượng phân trang
        return $query->paginate(5)->appends(['search' => $search, 'timeFrame' => $timeFrame]);
    }
}
