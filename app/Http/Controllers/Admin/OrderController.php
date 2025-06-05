<?php

namespace App\Http\Controllers\Admin;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Service\Order\OrderServiceInterface; // Chỉ cần import interface
use App\Exports\BestSellingProductsExport;
use Illuminate\Http\Request;
use App\Exports\TopCustomersExport;
class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->searchAndPagination('first_name', $request->get('search'));
    
        return view('admin/order/index', compact('orders'));
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
        $order = $this->orderService->find($id);

        return view('admin/order/show',compact('order'));
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
    public function bestSellingProducts(Request $request)
    {
        $timeFrame = $request->get('timeFrame', 'day'); // Mặc định là theo ngày
        $search = $request->get('search'); // Lấy từ query string nếu có

        // Lấy các sản phẩm bán chạy theo khung thời gian
        $productsQuery = $this->orderService->getBestSellingProducts($timeFrame);

        // Nếu có tìm kiếm, áp dụng bộ lọc tìm kiếm
        if (!empty($search)) {
            $productsQuery = $productsQuery->where('products.name', 'like', '%' . $search . '%');
        }

        // Phân trang kết quả
        $products = $productsQuery->paginate(5)->appends(['search' => $search]);

        return view('admin.report.product.productBestSeller', compact('products', 'timeFrame'));
    }
    public function exportBestSellingProducts(Request $request)
    {
        $timeFrame = $request->input('timeFrame', 'day');
        $search = $request->input('search', '');

        // Sử dụng cùng logic query như trong bestSellingProducts()
        $productsQuery = $this->orderService->getBestSellingProducts($timeFrame);

        if (!empty($search)) {
            $productsQuery = $productsQuery->where('products.name', 'like', '%' . $search . '%');
        }

        $products = $productsQuery->get();

        $fileName = 'best_selling_products_' . $timeFrame . '_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(
            new BestSellingProductsExport($products, $timeFrame),
            $fileName
        );
    }
    public function topCustomers(Request $request)
    {
        $timeFrame = $request->input('timeFrame', 'day');
        $search = $request->input('search', '');

        // Gọi từ repository đã sửa lỗi
        $customers = $this->orderService->getTopCustomersByRevenue($timeFrame, $search);

        return view('admin.report.customer.topCustomers', compact('customers', 'timeFrame', 'search'));
    }
    public function exportTopCustomers(Request $request)
    {
        $timeFrame = $request->get('timeFrame', 'day');
        $search = $request->get('search');

        $customers = $this->orderService->getTopCustomersByRevenue($timeFrame, $search);

        $fileName = 'top_customers_' . $timeFrame . '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(
            new TopCustomersExport($customers, $timeFrame),
            $fileName
        );
    }
}
