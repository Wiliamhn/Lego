@extends('admin.layout.master')
@section('title', 'Bài viết')
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
                    Bài viết
                    <div class="page-title-subheading">
                        Xem, tạo, cập nhật, xóa và quản lý.
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="./admin/blog/create" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Thêm mới
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">

                    <form method="GET" action="{{ route('admin.blog.filter') }}">
                        <div class="input-group">
                            <input type="hidden" name="timeFrame" value="{{ request('timeFrame', 'day') }}">
                            <input type="search" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Tìm kiếm..." class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp;
                                    Tìm kiếm
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="btn-actions-pane-right">
                        <a href="{{ route('admin.blog.export', [
                            'timeFrame' => request('timeFrame', 'day'),
                            'search' => request('search')
                        ]) }}"
                            class="btn-shadow btn-hover-shine mr-3 btn btn-success">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-file-excel fa-w-20"></i>
                            </span>
                            Xuất Excel
                        </a>
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ route('admin.blog.filter', ['timeFrame' => 'day', 'search' => request('search')]) }}" class="btn btn-focus {{ request('timeFrame', 'day') == 'day' ? 'active' : '' }}">Hôm nay</a>
                            <a href="{{ route('admin.blog.filter', ['timeFrame' => 'week', 'search' => request('search')]) }}" class="btn btn-focus {{ request('timeFrame') == 'week' ? 'active' : '' }}">Tuần này</a>
                            <a href="{{ route('admin.blog.filter', ['timeFrame' => 'month', 'search' => request('search')]) }}" class="btn btn-focus {{ request('timeFrame') == 'month' ? 'active' : '' }}">Tháng này</a>
                            <a href="{{ route('admin.blog.filter', ['timeFrame' => 'year', 'search' => request('search')]) }}" class="btn btn-focus {{ request('timeFrame') == 'year' ? 'active' : '' }}">Năm nay</a>
                        </div>
                    </div>

                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Người đăng</th>
                                <th>Tiêu đề / Phụ đề</th>
                                <th>Danh mục</th>
                                <th>Nội dung</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td class="text-center text-muted">#{{$blog->id}}</td>
                                <td class="text-center">{{ $blog->users->name }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img style="height: 60px;"
                                                        data-toggle="tooltip" title="Hình ảnh"
                                                        data-placement="bottom"
                                                        src="./front1/img/blog/{{ $blog->image}}" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $blog->title }}</div>
                                                <div class="widget-subheading opacity-7">
                                                    {{ $blog->subtitle }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $blog->category }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" onclick="toggleContent('{{ $blog->id }}')">
                                        Xem nội dung
                                    </button>
                                    <div id="content-{{ $blog->id }}" style="display: none; margin-top: 10px;">
                                        {!! $blog->content !!}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="./admin/blog/{{ $blog->id }}/edit" data-toggle="tooltip" title="Chỉnh sửa"
                                        data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                        <span class="btn-icon-wrapper opacity-8">
                                            <i class="fa fa-edit fa-w-20"></i>
                                        </span>
                                    </a>
                                    <form class="d-inline" action="./admin/blog/{{ $blog->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip" title="Xóa"
                                            data-placement="bottom"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-block card-footer">
                    {{$blogs->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main -->

<!-- jQuery & Bootstrap JS -->
<script>
    function toggleContent(id) {
        var contentDiv = document.getElementById("content-" + id);
        if (contentDiv.style.display === "none") {
            contentDiv.style.display = "block";
        } else {
            contentDiv.style.display = "none";
        }
    }
</script>

@endsection
