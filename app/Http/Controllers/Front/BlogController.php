<?php

namespace App\Http\Controllers\Front;
use App\Service\Blog\BlogServiceInterface;
use App\Service\blogComment\blogCommentServiceInterface;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $blogService;
    private $blogCommentService;

    public function __construct(
        BlogServiceInterface $blogService,
        BlogCommentServiceInterface $blogCommentService
    ) {
        $this->blogService = $blogService;
        $this->blogCommentService = $blogCommentService;
    }
    public function index(Request $request)
{
    $blogs = $this->blogService->searchAndPagination('title', $request->get('search'));
    $recentlyViewed = $this->getRecentlyViewedBlogs();

    // Lấy toàn bộ category không trùng lặp từ bảng blog (không phụ thuộc phân trang)
    $categories = Blog::select('category')->distinct()->pluck('category');

    return view('front.blog.index', compact('blogs', 'recentlyViewed', 'categories'));
}

    public function show($id)
    {
        $blog = $this->blogService->find($id);

        // Lưu bài viết vào session (bài viết đã xem)
        $this->addToRecentlyViewed($blog);

        // Lấy blog trước (có id nhỏ hơn blog hiện tại)
        $prevBlog = $this->blogService->findPreviousBlog($blog->id);

        // Lấy blog tiếp theo (có id lớn hơn blog hiện tại)
        $nextBlog = $this->blogService->findNextBlog($blog->id);

        // Lấy các bài viết đã xem gần đây
        $recentlyViewed = $this->getRecentlyViewedBlogs();

        return view('front.blog.show', compact('blog', 'prevBlog', 'nextBlog', 'recentlyViewed'));
    }

    public function postComment(Request $request)
    {
        // Check if the user is logged in
        if (!auth()->check()) {
            return redirect('account/login')->with('notification', 'You must be logged in to post comment.');
        }
        $this->blogCommentService->create($request->all());
        return redirect()->back();
    }


    private function addToRecentlyViewed($blog)
    {
        // Lấy danh sách ID bài viết đã xem từ session
        $recentlyViewedIds = session()->get('recently_viewed_ids', []); // Đổi tên key session cho rõ ràng

        // Kiểm tra xem ID bài viết đã tồn tại trong danh sách chưa
        $existingKey = array_search($blog->id, $recentlyViewedIds);

        if ($existingKey !== false) {
            // Nếu ID bài viết đã tồn tại, xóa nó khỏi danh sách hiện tại
            unset($recentlyViewedIds[$existingKey]);
        }

        // Thêm ID bài viết vào đầu danh sách
        array_unshift($recentlyViewedIds, $blog->id); // Chỉ lưu ID

        // Giới hạn số lượng bài viết đã xem (ví dụ 5 bài viết gần đây)
        if (count($recentlyViewedIds) > 5) {
            array_pop($recentlyViewedIds); // Xóa ID bài viết cuối cùng nếu quá số lượng
        }

        // Đảm bảo rằng chỉ mục của mảng là liên tiếp (không bắt buộc nếu chỉ dùng array_column sau này)
        $recentlyViewedIds = array_values($recentlyViewedIds);

        // Lưu lại vào session
        session()->put('recently_viewed_ids', $recentlyViewedIds);
    }






    private function getRecentlyViewedBlogs()
    {
        // Lấy danh sách ID bài viết đã xem từ session
        $recentlyViewedIds = session()->get('recently_viewed_ids', []); // Lấy trực tiếp mảng ID

        if (empty($recentlyViewedIds)) {
            return collect();
        }

        $orderedIdsString = implode(',', $recentlyViewedIds);

        $recentlyViewedBlogs = Blog::whereIn('id', $recentlyViewedIds)
            ->orderByRaw("FIELD(id, $orderedIdsString)")
            ->get();

        return $recentlyViewedBlogs;
    }

    public function filterByCategory($category)
{
    $blogs = $this->blogService->getBlogsByCategory($category);
    $recentlyViewed = $this->getRecentlyViewedBlogs();
    $categories = Blog::select('category')->distinct()->pluck('category');

    return view('front.blog.index', compact('blogs', 'recentlyViewed', 'categories'))
        ->with('filterCategory', $category);
}
}
