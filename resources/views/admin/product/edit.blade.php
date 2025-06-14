@extends('admin.layout.master')
@section('title','Sửa sản phẩm')
@section('body')

    <!-- Main -->
                <div class="app-main__inner">

                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Sản phẩm
                                    <div class="page-title-subheading">
                                        Xem, thêm, sửa, xóa.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form method="post" action="admin/product/{{$product->id}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="position-relative row form-group">
                                            <label for="brand_id"
                                                class="col-md-3 text-md-right col-form-label">Mục</label>
                                            <div class="col-md-9 col-xl-8">
                                                <select required name="brand_id" id="brand_id" class="form-control">
                                                    <option value="">-- Chọn --</option>
                                                    @foreach($brands as $brand)
                                                        <option {{$product->brand_id == $brand->id ? 'selected' : ''}} value={{$brand->id}}>
                                                            {{$brand->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="product_category_id"
                                                class="col-md-3 text-md-right col-form-label">Thể loại</label>
                                            <div class="col-md-9 col-xl-8">
                                                <select required name="product_category_id" id="product_category_id" class="form-control">
                                                    <option value="">-- Chọn --</option>
                                                    @foreach($productCategories as $category)
                                                        <option {{$product->product_category_id == $category->id ? 'selected' : ''}} value={{$category->id}}>
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="name" id="name" placeholder="Name" type="text"
                                                    class="form-control" value="{{$product->name}}">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="content"
                                                class="col-md-3 text-md-right col-form-label">Nội dung</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="content" id="content"
                                                    placeholder="Content" type="text" class="form-control" value="{{$product->content}}">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="price"
                                                class="col-md-3 text-md-right col-form-label">Giá</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="price" id="price"
                                                    placeholder="Price" type="text" class="form-control" value="{{$product->price}}">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="discount"
                                                class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="discount" id="discount" placeholder="Discount" type="text" class="form-control" value="{{$product->discount}}" >
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="discount"
                                                   class="col-md-3 text-md-right col-form-label">Số lượng</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="qty" id="qty" placeholder="Số lượng" type="text" class="form-control" value="{{$product->qty}}" >
                                            </div>
                                        </div>


                                        <div class="position-relative row form-group">
                                            <label for="sku"
                                                class="col-md-3 text-md-right col-form-label">Mã hàng hóa</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="sku" id="sku"
                                                    placeholder="SKU" type="text" class="form-control" value="{{$product->sku}}">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="tag"
                                                class="col-md-3 text-md-right col-form-label">Nhãn</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="tag" id="tag"
                                                    placeholder="Tag" type="text" class="form-control" value="{{$product->tag}}">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="featured"
                                                class="col-md-3 text-md-right col-form-label">Featured</label>
                                            <div class="col-md-9 col-xl-8">
                                                <div class="position-relative form-check pt-sm-2">
                                                    <input name="featured" id="featured" type="checkbox" value="1" {{$product->featured ? 'checked' : ''}}
                                                           class="form-check-input">
                                                    <label for="featured" class="form-check-label">Featured</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="description"
                                                class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                            <div class="col-md-9 col-xl-8">
                                                <textarea class="form-control" name="description" id="description"
                                                          placeholder="Description">{{$product->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group mb-1">
                                            <div class="col-md-9 col-xl-8 offset-md-2">
                                                <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                                        <i class="fa fa-times fa-w-20"></i>
                                                    </span>
                                                    <span>Cancel</span>
                                                </a>

                                                <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                                        <i class="fa fa-download fa-w-20"></i>
                                                    </span>
                                                    <span>Save</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description')
    </script>
                <!-- End Main -->

@endsection
