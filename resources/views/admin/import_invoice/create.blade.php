@extends('admin.layout.master')
@section('title', 'Create Import Invoice')
@section('body')

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box2 icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Create Import Invoice
                    <div class="page-title-subheading">
                        Create a new import invoice with supplier and product details.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/import-invoice') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="position-relative row form-group">
                            <label for="supplier_id" class="col-md-3 text-md-right col-form-label">Supplier</label>
                            <div class="col-md-9 col-xl-8">
                                <select name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="import_date" class="col-md-3 text-md-right col-form-label">Import Date</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="import_date" id="import_date" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-3">Products</h5>

                        <div id="product-rows">
                            <div class="form-row align-items-center mb-2 product-row">
                                <div class="col-md-5">
                                    <select name="products[]" class="form-control select2" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="quantities[]" min="1" class="form-control quantity" placeholder="Qty" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="prices[]" step="0.01" class="form-control price" placeholder="Price" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control total" placeholder="Total" readonly>
                                </div>
                                <div class="col-md-1 text-left">
                                    <button type="button" class="btn btn-danger remove-product">X</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="button" id="add-product" class="btn btn-info mx-auto">
                                + Add Product
                            </button>
                        </div>

                        <div class="position-relative row form-group mt-4 mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-5">
                                <a href="{{ url('admin/import-invoice') }}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    Cancel
                                </a>

                                <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Thêm vào phần <head> hoặc trước thẻ đóng </body> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Khởi tạo Select2 cho các thẻ <select> ban đầu
        $('.select2').select2();

        // Thêm sản phẩm mới
        $('#add-product').click(function() {
            var newRow = `
            <div class="form-row align-items-center mb-2 product-row">
                <div class="col-md-5">
                    <select name="products[]" class="form-control select2" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="quantities[]" min="1" class="form-control quantity" placeholder="Qty" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="prices[]" step="0.01" class="form-control price" placeholder="Price" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control total" placeholder="Total" readonly>
                </div>
                <div class="col-md-1 text-left">
                    <button type="button" class="btn btn-danger remove-product">X</button>
                </div>
            </div>
            `;
            $('#product-rows').append(newRow);

            // Khởi tạo lại Select2 cho các thẻ <select> mới
            $('#product-rows .select2').last().select2();
        });

        // Xóa sản phẩm
        $(document).on('click', '.remove-product', function() {
            $(this).closest('.product-row').remove();
        });

        // Tính tổng tiền khi thay đổi số lượng hoặc giá
        $(document).on('input', '.quantity, .price', function() {
            var row = $(this).closest('.product-row');
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var price = parseFloat(row.find('.price').val()) || 0;
            var total = quantity * price;
            row.find('.total').val(total.toFixed(2)); // Hiển thị tổng tiền với 2 chữ số thập phân
        });
    });
</script>
@endsection