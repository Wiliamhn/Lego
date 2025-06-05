<?php

namespace App\Repositories\ProductView;


use App\Models\ProductView;
use App\Repositories\BaseRepositories;
use Carbon\Carbon;

class ProductViewRepository extends BaseRepositories implements ProductViewRepositoryInterface
{
    public function getModel()
    {
        return ProductView::class;
    }
    public function getTopViewedProducts($timeFrame)
    {
        $query = ProductView::query();

        switch ($timeFrame) {
            case 'day':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }

        return $query
            ->selectRaw('product_id, COUNT(*) as views_count')
            ->groupBy('product_id')
            ->orderByDesc('views_count')
            ->with('product') // Eager loading để lấy thông tin sản phẩm
            ->paginate(10);
    }
}
