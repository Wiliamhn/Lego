@extends('admin.layout.master')
@section('title', 'Bài viết')
@section('body')
<!-- Nội dung chính -->
<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Bài viết
                    <div class="page-title-subheading">
                        Xem, tạo, cập nhật, xóa và quản lý bài viết.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form method="post" action="admin/blog/{{ $blog->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.components.notification')

                        <div class="position-relative row form-group">
                            <label for="image" class="col-md-3 text-md-right col-form-label">Hình ảnh</label>
                            <div class="col-md-9 col-xl-8">
                                <img style="height: 200px; cursor: pointer;"
                                     class="thumbnail rounded-circle" data-toggle="tooltip"
                                     title="Nhấn để thay đổi hình ảnh" data-placement="bottom"
                                     src="front1/img/blog/{{ $blog->image }}" alt="Avatar">
                                <input name="image" type="file" onchange="changeImg(this)"
                                       class="image form-control-file" style="display: none;" value="">
                                <input type="hidden" name="image_old" value="{{ $blog->avatar }}">
                                <small class="form-text text-muted">
                                    Nhấn vào hình để thay đổi (bắt buộc)
                                </small>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="user_id" class="col-md-3 text-md-right col-form-label">Tên người dùng</label>
                            <div class="col-md-9 col-xl-8">
                                <select required name="user_id" id="user_id" class="form-control">
                                    <option value="">-- Chọn người dùng --</option>
                                    @foreach($users as $user)
                                        <option {{$blog->user_id == $user->id ? 'selected' : ''}} value="{{$user->id}}">
                                            {{$user->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="title" class="col-md-3 text-md-right col-form-label">Tiêu đề</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="title" id="title" placeholder="Tiêu đề" type="text"
                                       class="form-control" value="{{$blog->title}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="subtitle" class="col-md-3 text-md-right col-form-label">Phụ đề</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="subtitle" id="subtitle"
                                       placeholder="Phụ đề" type="text" class="form-control" value="{{$blog->subtitle}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="category" class="col-md-3 text-md-right col-form-label">Danh mục</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="category" id="category"
                                       placeholder="Danh mục" type="text" class="form-control" value="{{$blog->category}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control" name="content" id="content" placeholder="Nội dung">{{ $blog->content }}</textarea>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="./admin/blog" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Hủy</span>
                                </a>

                                <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kết thúc nội dung chính -->
{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    // Khởi tạo CKEditor cho textarea có id 'content'
    CKEDITOR.replace('content');
</script>
@endsection
