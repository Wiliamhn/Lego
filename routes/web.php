<?php

use App\Http\Controllers\Front\NguoiDungController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CheckMemberLogin;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\GooleController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// web.php
Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');


Route::prefix('shop')->group(function () {
    Route::get('product/{id}', [App\Http\Controllers\Front\ShopController::class, 'show']);
    Route::post('product/{id}', [App\Http\Controllers\Front\ShopController::class, 'postComment']);
    Route::get('', [App\Http\Controllers\Front\ShopController::class, 'index']);
    Route::get('category/{categoryName}', [App\Http\Controllers\Front\ShopController::class, 'category']);
    Route::get('brand/{brandName}', [App\Http\Controllers\Front\ShopController::class, 'brand']);
});
Route::prefix('blog')->group(function () {
    Route::get('', [App\Http\Controllers\Front\BlogController::class, 'index'])->name('blog.index');
    Route::get('category/{category}', [App\Http\Controllers\Front\BlogController::class, 'filterByCategory'])->name('blog.category');
    Route::get('blog/{id}', [App\Http\Controllers\Front\BlogController::class, 'show'])->where('id', '[0-9]+')->name('frontend.blog.show');

    Route::post('{id}', [App\Http\Controllers\Front\BlogController::class, 'postComment'])->where('id', '[0-9]+')->name('blog.comment');
});



Route::prefix('cart')->group(function () {
    Route::get('add', [App\Http\Controllers\Front\CartController::class, 'add']);
    Route::get('/', [App\Http\Controllers\Front\CartController::class, 'index']);
    Route::get('delete', [App\Http\Controllers\Front\CartController::class, 'delete']);
    Route::get('destroy', [App\Http\Controllers\Front\CartController::class, 'destroy']);
    Route::get('update', [App\Http\Controllers\Front\CartController::class, 'update']);
});
Route::prefix('checkout')->middleware('CheckMemberLogin')->group(function () {
    Route::get('', [App\Http\Controllers\Front\CheckoutController::class, 'index']);
    Route::post('/', [App\Http\Controllers\Front\CheckoutController::class, 'addOrder']);
    Route::get('/result', [App\Http\Controllers\Front\CheckoutController::class, 'result']);
    Route::get('/vnPayCheck', [App\Http\Controllers\Front\CheckoutController::class, 'vnPayCheck']);
});


Route::prefix('account')->group(function () {
    Route::get('login', [App\Http\Controllers\Front\AccountController::class, 'login'])->name('account.login');;;
    Route::post('login', [App\Http\Controllers\Front\AccountController::class, 'checkLogin']);
    Route::get('logout', [App\Http\Controllers\Front\AccountController::class, 'logout']);
    Route::get('register', [App\Http\Controllers\Front\AccountController::class, 'register']);
    Route::post('register', [App\Http\Controllers\Front\AccountController::class, 'postRegister']);
    Route::prefix('my-order')->middleware('CheckMemberLogin')->group(function () {
        Route::get('/', [App\Http\Controllers\Front\AccountController::class, 'myOrderIndex']);
        Route::get('{id}', [App\Http\Controllers\Front\AccountController::class, 'myOrderShow']);
    });
    // Route sửa thông tin tài khoản người dùng
    Route::middleware('CheckMemberLogin')->group(function () {
        Route::get('profile/edit', [App\Http\Controllers\Front\AccountController::class, 'edit'])->name('account.edit');
        Route::put('profile/edit', [App\Http\Controllers\Front\AccountController::class, 'update'])->name('account.update');
    });

    Route::get('password/forgot', [App\Http\Controllers\Front\AccountController::class, 'forgotPasswordForm'])->name('password.forgot');
    Route::post('password/forgot', [App\Http\Controllers\Front\AccountController::class, 'forgotPasswordFormPost'])->name('password.forgot.post');
    Route::get('password/forgot/{token}', [App\Http\Controllers\Front\AccountController::class, 'showLinkForm'])->name('password.forgot.link');
    Route::post('password/email/submit', [App\Http\Controllers\Front\AccountController::class, 'resetPassword'])->name('password.forgot.link.submit');
});

//Admin
Route::prefix('admin')->middleware('CheckAdminLogin')->group(function () {
    Route::redirect('', 'admin/user');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('category', App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product/{product_id}/image', App\Http\Controllers\Admin\ProductImageController::class);
    Route::resource('order', App\Http\Controllers\Admin\OrderController::class);
    Route::get('/admin/top-customers/export', [App\Http\Controllers\Admin\OrderController::class, 'exportTopCustomers'])->name('admin.topCustomers.export');
    Route::resource('blog', App\Http\Controllers\Admin\BlogController::class);
    Route::get('/admin/blog/export', [App\Http\Controllers\Admin\BlogController::class, 'export'])->name('admin.blog.export');

    Route::get('/statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('admin.statistics.index');
    Route::get('/statistics/data', [App\Http\Controllers\Admin\StatisticsController::class, 'getRevenueProfitData'])->name('admin.statistics.data');
    Route::get('/statistics/export', [App\Http\Controllers\Admin\StatisticsController::class, 'exportExcel'])->name('admin.statistics.export');
    Route::prefix('login')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\HomeController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('', [App\Http\Controllers\Admin\HomeController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
    
    });
    Route::resource('supplier', App\Http\Controllers\Admin\SupplierController::class);
    Route::post('suppliers-import', [App\Http\Controllers\Admin\SupplierController::class, 'import'])->name('suppliers.import');
    Route::get('suppliers-export', [App\Http\Controllers\Admin\SupplierController::class, 'export'])->name('suppliers.export');
    // Route quản lý hóa đơn nhập (Import Invoice)
    Route::resource('import-invoice', App\Http\Controllers\Admin\ImportInvoiceController::class);

    // Nếu bạn sau này cần Import/Export hóa đơn nhập bằng Excel, thêm:
    Route::get('admin/import-invoice/{id}/export-details', [App\Http\Controllers\Admin\ImportInvoiceController::class, 'exportDetails'])->name('importInvoice.exportDetails');
    Route::get('import-invoice-export', [App\Http\Controllers\Admin\ImportInvoiceController::class, 'export'])->name('importInvoice.export');

    Route::get('logout', [App\Http\Controllers\Admin\HomeController::class, 'logout']);
    Route::prefix('report')->group(function () {
        Route::prefix('product')->group(function () {
            

            // Đặt tên cho route productBestSeller
            Route::get('productBestSeller', [App\Http\Controllers\Admin\OrderController::class, 'bestSellingProducts'])->name('admin.report.product.productBestSeller');
            Route::get('/admin/report/best-selling-products/export', [App\Http\Controllers\Admin\OrderController::class, 'exportBestSellingProducts'])->name('admin.report.exportBestSellingProducts');



            

            Route::get('topViewedProducts', [App\Http\Controllers\Admin\ProductViewController::class, 'index'])->name('admin.report.product.topViewedProducts');
            Route::get('/admin/report/top-viewed-products/export', [App\Http\Controllers\Admin\ProductViewController::class, 'exportTopViewedProducts'])->name('admin.report.exportTopViewedProducts');
        });
    });
});
Route::get('admin/blogs', [App\Http\Controllers\Admin\BlogController::class, 'index'])
    ->name('admin.blog.filter');
Route::get("auth/google", [App\Http\Controllers\Front\AccountController::class, 'redirectToGoogle'])->name('redirect.google');
Route::get("auth/google/callback", [App\Http\Controllers\Front\AccountController::class, 'handleGoogleCallback']);

Route::get('admin/report/customer/topCustomers', [App\Http\Controllers\Admin\OrderController::class, 'topCustomers'])
    ->name('admin.topCustomers');