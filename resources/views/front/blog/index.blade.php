@extends('front.layout.master')

@section('title', 'Blog')

@section('body')
<!-- Blog Section Begin -->
<section class="blog-section spad" style="padding: 60px 0;margin-top:100px;">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 mb-4 mb-lg-0">
                <div class="blog-sidebar" style="padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <!-- Search -->
                    <div class="search-form mb-4">
                        <h4 style="font-weight: 600; margin-bottom: 15px;">Tìm kiếm</h4>
                        <form action="{{ url('blog') }}">
                            <div class="input-group">
                                <input type="search" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Tìm bất cứ thứ gì" class="form-control"
                                    style="border-radius: 4px 0 0 4px; border: 1px solid #ccc;">
                                <button type="submit" class="btn btn-dark" style="border-radius: 0 4px 4px 0;"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Category -->
                    <div class="blog-catagory mb-4">
                        <h4 style="font-weight: 600; margin-bottom: 15px;">Thể loại</h4>
                        <ul style="list-style: none; padding-left: 0; margin: 0;">
                            @foreach($categories as $category)
                            <li style="margin-bottom: 8px;">
                                <a href="{{ url('blog/category/' . $category) }}" style="color: #007bff; text-decoration: none;">
                                    {{ $category }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Recent Post -->
                    <div class="recent-post">
                        <h4 style="font-weight: 600; margin-bottom: 15px;">Tin vừa xem</h4>
                        <div class="recent-blog">
                            @foreach($recentlyViewed as $viewedBlog)
                            <a href="{{ route('blog.show', $viewedBlog->id) }}" class="rb-item d-flex mb-3"
                                style="text-decoration: none; color: inherit;">
                                <div class="rb-pic me-3"
                                    style="width: 70px; height: 70px; overflow: hidden; border-radius: 6px; flex-shrink: 0;">
                                    <img src="{{ asset('front1/img/blog/' . ($viewedBlog->image ?? 'default.jpg')) }}"
                                        alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="rb-text">
                                    <h6 style="font-size: 14px; font-weight: 600; margin-bottom: 4px;">{{ $viewedBlog->title }}</h6>
                                    <p style="font-size: 13px; color: #777; margin: 0;">{{ $viewedBlog->category }}
                                        <span>- {{ optional($viewedBlog->created_at)->format('M d, Y') }}</span>
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Content -->
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row">
                    @forelse($blogs as $blog)
                    <div class="col-lg-6 col-sm-6 mb-4">
                        <div class="blog-item"
                            style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.3s;">
                            <div class="bi-pic" style="height: 220px; overflow: hidden;">
                                <img src="{{ asset('front1/img/blog/' . ($blog->image ?? 'default.jpg')) }}" alt=""
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="bi-text p-3">
                                <a href="{{ route('frontend.blog.show', $blog->id) }}">

                                    <h4 style="font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #333;">{{ $blog->title }}</h4>
                                </a>
                                <p style="color: #777;">{{ $blog->category }}
                              -  {{ date('d/m/Y', strtotime($blog->created_at)) }}</span></p>
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p style="text-align: center;">Không có blog nào để hiển thị.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection
