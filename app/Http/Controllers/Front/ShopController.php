<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Service\Product\ProductService;
use App\Service\ProductCategory\ProductCategoryService;
use App\Service\ProductComment\BlogServiceInterface;
use App\Service\ProductComment\ProductCommentServiceInterface;
use App\Service\Brand\BrandService;
use App\Models\ProductView;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;
    private $productCategoryService;
    private $productBrandService;


    public function __construct(
        ProductService $productService,
        ProductCommentServiceInterface $productCommentService,
        ProductCategoryService $productCategoryService,
        BrandService $productBrandService
    ) {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->productCategoryService = $productCategoryService;
        $this->productBrandService = $productBrandService;
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        ProductView::create([
            'product_id' => $id,
        ]);
        $relatedProducts = $this->productService->getRelatedProducts($product);

        return view('front.shop.show', compact('product', 'relatedProducts'));
    }
    public function postComment(Request $request)
    {
        $this->productCommentService->create($request->all());

        return redirect()->back();
    }
    public function index(Request $request)
    {
        $brands = $this->productBrandService->all();
        $categories = $this->productCategoryService->all();
        $products = $this->productService->getProductOnIndex($request);

        return view('front.shop.index', compact('products', 'categories', 'brands'));
    }
   public function category($categoryName, Request $request)
{
    $categories = $this->productCategoryService->all();
    $brands = $this->productBrandService->all(); // thêm dòng này
    $products = $this->productService->getProductsByCategory($categoryName, $request);

    return view('front.shop.index', compact('products', 'categories', 'brands'));
}

    public function brand($brandName, Request $request)
{
    $brands = $this->productBrandService->all();
    $categories = $this->productCategoryService->all(); // thêm dòng này
    $products = $this->productService->getProductsByBrand($brandName, $request);

    return view('front.shop.index', compact('products', 'brands', 'categories'));
}

}
