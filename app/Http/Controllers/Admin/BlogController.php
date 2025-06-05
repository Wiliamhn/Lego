<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Service\Blog\BlogService;
use App\Service\Blog\BlogServiceInterface;
use App\Service\User\UserService;
use App\Utilities\Common;

class BlogController extends Controller
{
  private $blogService;
    private $userService;
    public function __construct(BlogService $blogService,
                                UserService $userService)
    {
        $this->blogService = $blogService;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $timeFrame = $request->input('timeFrame', 'day'); // Mặc định là 'day'
        $search = $request->input('search', '');

        // Truy vấn từ Model Blog
        $query = \App\Models\Blog::query();

        // Lọc theo thời gian
        switch ($timeFrame) {
            case 'day':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        // Nếu có tìm kiếm theo tên khách hàng
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(5)->appends([
            'timeFrame' => $timeFrame,
            'search' => $search,
        ]);

        return view('admin.blog.index', compact('blogs', 'timeFrame', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userService->all();
        return view('admin.blog.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->all();



        //Xử lý file:
        if ($request->hasFile('image')) {
            $data['image'] = Common::uploadFile($request->file('image'), 'front1/img/blog');
        }

        $blog = $this->blogService->create($data);

        return redirect('admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = $this->blogService->find($id);
        $users = $this->userService->all();
        return view('admin.blog.edit', compact('blog','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    if ($request->hasFile('image')) {
        // Lấy file từ request
        $file = $request->file('image');

        // Tạo tên file mới (nếu muốn)
        $filename = time() . '-' . $file->getClientOriginalName();

        // Di chuyển file vào thư mục public/front/img/blog
        $file->move(public_path('front1/img/blog'), $filename);

        // Cập nhật lại tên ảnh cho blog
        $blog->image = $filename;
    }

    // Các cập nhật khác
    $blog->title = $request->title;
    $blog->subtitle = $request->subtitle;
    $blog->category = $request->category;
    $blog->content = $request->content;
    $blog->user_id = $request->user_id;

    $blog->save();

    return redirect()->back()->with('success', 'Blog updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->blogService->delete($id);
        return redirect('admin/blog');
    }

   

    protected function getFilteredBlogs($timeFrame, $search)
    {
        $query = Blog::query() // Bỏ with(['users']) vì không cần thông tin user
        ->when($timeFrame, function($query) use ($timeFrame) {
            switch ($timeFrame) {
                case 'day':
                    return $query->whereDate('created_at', today());
                case 'week':
                    return $query->whereBetween('created_at', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]);
                case 'month':
                    return $query->whereMonth('created_at', now()->month);
                case 'year':
                    return $query->whereYear('created_at', now()->year);
            }
        })
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('title', 'like', '%'.$search.'%')
                        ->orWhere('subtitle', 'like', '%'.$search.'%')
                        ->orWhere('category', 'like', '%'.$search.'%');
                });
            })
            ->orderBy('created_at', 'desc');

        return $query;
    }

}
