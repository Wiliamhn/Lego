<?php

namespace App\Providers;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Service\Blog\BlogService;
use App\Service\Blog\BlogServiceInterface;
use App\Service\blogComment\blogCommentService;
use App\Service\blogComment\blogCommentServiceInterface;
use App\Repositories\blogComment\blogCommentRepository;
use App\Repositories\blogComment\blogCommentRepositoryInterface;
use App\Service\Brand\BrandService;
use App\Service\Brand\BrandServiceInterface;
use App\Service\Order\OrderService;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Service\Product\ProductService;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductCategory\ProductCategoryService;
use App\Service\ProductCategory\ProductCategoryServiceInterface;
use App\Service\ProductComment\ProductCommentService;
use App\Service\ProductComment\ProductCommentServiceInterface;
use App\Service\User\UserService;
use App\Service\User\UserServiceInterface;
use App\Repositories\DiscountCode\DiscountCodeRepository;
use App\Repositories\DiscountCode\DiscountCodeRepositoryInterface;
use App\Service\DiscountCode\DiscountCodeService;
use App\Service\DiscountCode\DiscountCodeServiceInterface;
use App\Repositories\ProductView\ProductViewRepository;
use App\Repositories\ProductView\ProductViewRepositoryInterface;
use App\Service\ProductView\ProductViewService;
use App\Service\ProductView\ProductViewServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Service\Supplier\SupplierService;
use App\Service\Supplier\SupplierServiceInterface;
use App\Repositories\ImportInvoice\ImportInvoiceRepository;
use App\Repositories\ImportInvoice\ImportInvoiceRepositoryInterface;
use App\Service\ImportInvoice\ImportInvoiceService;
use App\Service\ImportInvoice\ImportInvoiceServiceInterface;
use App\Repositories\ImportInvoiceDetail\ImportInvoiceDetailRepository;
use App\Repositories\ImportInvoiceDetail\ImportInvoiceDetailRepositoryInterface;
use App\Service\ImportInvoiceDetail\ImportInvoiceDetailService;
use App\Service\ImportInvoiceDetail\ImportInvoiceDetailServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );
        //ProductComment
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );

        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );

        //ProductView
        $this->app->singleton(
            ProductViewRepositoryInterface::class,
            ProductViewRepository::class
        );
        $this->app->singleton(
            ProductViewServiceInterface::class,
            ProductViewService::class
        );
        //Blogs
        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );
        //BlogComment
         $this->app->singleton(
            BlogCommentRepositoryInterface::class,
            BlogCommentRepository::class
        );

        $this->app->singleton(
            BlogCommentServiceInterface::class,
            BlogCommentService::class
        );
        //ProductCategory
        $this->app->singleton(
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class
        );

        $this->app->singleton(
            ProductCategoryServiceInterface::class,
            ProductCategoryService::class
        );
        //Order
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );
        //OrderDetail
        $this->app->singleton(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class
        );

        $this->app->singleton(
            OrderDetailServiceInterface::class,
            OrderDetailService::class
        );
               //Supplier
        $this->app->singleton(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );
        $this->app->singleton(
            SupplierServiceInterface::class,
            SupplierService::class
        );
            //ImportInvoice
        $this->app->singleton(
            ImportInvoiceRepositoryInterface::class,
            ImportInvoiceRepository::class
        );
        $this->app->singleton(
            ImportInvoiceServiceInterface::class,
            ImportInvoiceService::class
        );
         //ImportInvoiceDetail
        $this->app->singleton(
            ImportInvoiceDetailRepositoryInterface::class,
            ImportInvoiceDetailRepository::class
        );
        $this->app->singleton(
            ImportInvoiceDetailServiceInterface::class,
            ImportInvoiceDetailService::class
        );
        //User
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );
        //Brand
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );
        $this->app->singleton(
            DiscountCodeRepositoryInterface::class,
            DiscountCodeRepository::class
        );
        $this->app->singleton(
            DiscountCodeServiceInterface::class,
            DiscountCodeService::class
        );


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
