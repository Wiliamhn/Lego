@extends('front.layout.master')

@section('title', 'Blog')

@section('body')


<!-- Blog Details Section Begin -->
<section class="blog-details spad" style="padding: 60px 0;">
    <div class="container d-flex justify-content-center">
        <div class="row" style="max-width: 900px; width: 100%;">
            <div class="col-12">
                <div class="blog-details-inner">
                    <div class="blog-detail-title" style="margin-bottom: 30px;">
                        <h2 style="font-size: 32px; font-weight: bold; margin-bottom: 10px;">{{$blog->title}}</h2>
                        <p style="font-size: 16px; color: #888;">{{$blog->category}}
                            <span style="color: #555; font-style: italic;">- {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</span>
                        </p>
                    </div>
                    <div class="blog-large-pic">
                        <img src="{{ asset('front1/img/blog/' . ($blog->image ?? 'default.jpg')) }}" alt="">
                    </div>
                    <div style="font-family: 'Segoe UI', sans-serif; font-size: 16px; line-height: 1.8; color: #333; padding: 15px; background-color: #fff;">
                        {!! $blog->content !!}
                    </div>
                    <div class="blog-large-pic">
                        <img src="{{ asset('front1/img/blog/' . ($blog->image_old ?? 'default.jpg')) }}" alt="">
                    </div>

                    <div class="tag-share" style="margin-top: 20px;">
                        <div class="details-tag" style="margin-bottom: 20px;">
                            <ul style="display: flex; gap: 10px; list-style: none; padding-left: 0;">
                                <li><i class="fa fa-tags" style="color: #ff6b6b;"></i></li>
                                <li>{{$blog->category}}</li>
                            </ul>
                        </div>
                        <div class="blog-share" style="display: flex; align-items: center; gap: 10px;">
                            <span>Chia sẻ:</span>
                            <div class="social-links">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" title="Chia sẻ Facebook">
                                    <i class="fab fa-facebook" style="font-size: 16px; color: #555;"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($blog->title) }}" target="_blank" title="Chia sẻ Twitter">
                                    <i class="fab fa-twitter" style="font-size: 16px; color: #555;"></i>
                                </a>
                                <a href="#" onclick="copyToClipboard('{{ Request::url() }}'); return false;" title="Sao chép liên kết">
                                    <i class="fa fa-copy" style="font-size: 16px; color: #555;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                  

                    <div class="blog-post" style="margin-top: 40px;">
                        <div class="row">
                            @if($prevBlog)
                            <div class="col-lg-5 col-md-6">
                                <a href="blog/{{$prevBlog->id}}" class="prev-blog" style="display: flex; align-items: center;">
                                    <div class="pb-pic" style="margin-right: 15px;">
                                        <i class="ti-arrow-left"></i>
                                        <img src="front1/img/blog//{{$prevBlog->image ?? ''}}" alt="" style="max-width: 100px;">
                                    </div>
                                    <div class="pb-text">
                                        <span style="font-size: 14px; color: #888;">Bài trước:</span>
                                        <h5 style="margin: 0;">{{ $prevBlog->title }}</h5>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if($nextBlog)
                            <div class="col-lg-5 offset-lg-2 col-md-6">
                                <a href="blog/{{$nextBlog->id}}" class="next-blog" style="display: flex; align-items: center;">
                                    <div class="nb-pic" style="margin-right: 15px;">
                                        <img src="front1/img/blog/{{$nextBlog->image ?? ''}}" alt="" style="max-width: 100px;">
                                        <i class="ti-arrow-right"></i>
                                    </div>
                                    <div class="nb-text">
                                        <span style="font-size: 14px; color: #888;">Bài tiếp theo:</span>
                                        <h5 style="margin: 0;">{{ $nextBlog->title }}</h5>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="posted-by" style="margin-top: 40px; border-top: 1px solid #ddd; padding-top: 30px;">
                        @foreach($blog->blogComments as $blogComment)
                        <div class="pb-pic" style="float: left; margin-right: 15px;">
                            <img style="height: 60px" src="front1/img/user/{{$blogComment->user->avatar ?? 'default-avatar.PNG'}}" alt="">
                        </div>
                        <div class="pb-text" style="overflow: hidden;">
                            <a href="#">
                                <h5 style="font-size: 16px; font-weight: 600;">{{$blogComment->name}}
                                    <span style="font-size: 14px; color: #888;">- {{ \Carbon\Carbon::parse($blogComment->created_at)->format('d/m/Y') }}</span>
                                </h5>
                            </a>
                            <p>{{ $blogComment->messages}}</p>
                        </div>
                        <div style="clear: both; margin-bottom: 20px;"></div>
                        @endforeach
                    </div>

                    <div class="leave-comment" style="margin-top: 50px;">
                        <h4 style="text-align: center;">Để lại bình luận</h4>
                        <div style="max-width: 900px; margin: 0 auto;">
                            <form action="{{ route('blog.comment', $blog->id) }}" method="post" class="comment-form">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null}}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Tên" name="name" value="{{Auth::user()->name ?? ''}}" style="margin-bottom: 20px; width: 100%; padding: 10px 15px; border: 1px solid #ccc; border-radius: 6px;">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Email" name="email" value="{{Auth::user()->email ?? ''}}" style="margin-bottom: 20px; width: 100%; padding: 10px 15px; border: 1px solid #ccc; border-radius: 6px;">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Nội dung bình luận" name="messages" style="margin-bottom: 20px; width: 100%; padding: 10px 15px; border: 1px solid #ccc; border-radius: 6px;"></textarea>
                                        <div style="text-align: right;">
                                            <button type="submit" class="site-btn" style="background-color: #ff6b6b; color: #fff; padding: 10px 25px; border: none; border-radius: 6px;">Gửi bình luận</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Đã sao chép liên kết bài viết!');
        }, function(err) {
            alert('Lỗi khi sao chép liên kết: ' + err);
        });
    }
</script>

@endsection