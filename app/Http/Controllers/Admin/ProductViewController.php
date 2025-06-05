<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TopViewedProductsExport;
use App\Http\Controllers\Controller;
use App\Models\ProductView;
use App\Service\ProductView\ProductViewServiceInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productViewService;

    public function __construct(ProductViewServiceInterface $productViewService)
    {
        $this->productViewService = $productViewService;
    }
    public function index(Request $request)
    {
        $timeFrame = $request->input('time_frame', 'day');
        $topViewedProducts = $this->productViewService->getTopViewedProducts($timeFrame);

        return view('admin.report.product.topViewedProducts', compact('topViewedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportTopViewedProducts(Request $request)
    {
        $timeFrame = $request->input('time_frame', 'day');

        // Sử dụng cùng logic query như trong topViewedProducts()
        $products = $this->getTopViewedProductsQuery($timeFrame)->get();

        $fileName = 'top_viewed_products_' . $timeFrame . '_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(
            new TopViewedProductsExport($products, $timeFrame),
            $fileName
        );
    }

    protected function getTopViewedProductsQuery($timeFrame)
    {
        return ProductView::selectRaw('product_id, COUNT(*) as views_count')
            ->with(['product', 'product.brand'])
            ->when($timeFrame, function($query) use ($timeFrame) {
                switch ($timeFrame) {
                    case 'day':
                        return $query->whereDate('created_at', today());
                    case 'week':
                        return $query->whereBetween('created_at', [
                            now()->startOfWeek(),
                            now()->endOfWeek()
                        ]);
                    case 'month':
                        return $query->whereMonth('created_at', now()->month);
                    case 'year':
                        return $query->whereYear('created_at', now()->year);
                }
            })
            ->groupBy('product_id')
            ->orderByDesc('views_count');
    }
}
