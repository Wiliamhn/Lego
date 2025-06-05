<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Repositories\BaseRepositories;
use http\Env\Request;

class ProductRepository extends  BaseRepositories implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }
    public function getRelatedProducts($product, $limit = 4)
    {
        return $this->model->where('product_category_id', $product->product_category_id)
            ->where('tag', $product->tag)
            ->limit($limit)
            ->get();
    }
    public function getFeaturedProductsByCategory(int $categoryId)
    {
        return $this->model->where('featured', true)
            ->where('product_category_id', $categoryId)
            ->get();
    }
    public function getProductOnIndex($request)
    {

        $search = $request->search ?? '';

        $products = $this->model->where('name', 'like', '%' . $search . '%');

        $products = $this->sortAndPagination($products, $request);
        return $products;
    }
    public function getProductsByCategory($categoryName, $request)
    {
        $products = ProductCategory::where('name', $categoryName)->first()->products->toQuery();
        $products = $this->sortAndPagination($products, $request);
        return $products;
    }
    public function getProductsByBrand($brandName, $request)
    {
        $brand = Brand::where('name', $brandName)->first();

        if (!$brand) {
            // xử lý khi không tìm thấy brand, có thể trả về collection rỗng hoặc báo lỗi
            return collect();
        }

        // Lấy query builder của products liên quan
        $productsQuery = $brand->products()->orderBy('id', 'desc'); // ví dụ orderBy

        // Phân trang (ví dụ 10 sản phẩm 1 trang)
        $products = $productsQuery->paginate(10);

        // Bạn có thể thêm xử lý sort theo $request ở đây nếu muốn

        return $products;
    }


    private function sortAndPagination($products, $request)
    {
        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'lastest';
        switch ($sortBy) {
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }
        $products = $products->paginate(8);
        $products->appends(['sort_by' => $sortBy]);
        return $products;
    }
}
