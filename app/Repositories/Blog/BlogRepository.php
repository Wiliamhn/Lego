<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepositories;

class BlogRepository extends BaseRepositories implements BlogRepositoryInterface
{

    public function getModel()
    {
        return Blog::class;
    }
    public function getLatestBlogs($limit = 3)
    {
        return $this->model->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }
    public function findPreviousBlog($currentBlogId)
    {
        // Truy vấn blog trước dựa trên ID nhỏ hơn blog hiện tại, sắp xếp giảm dần
        return Blog::where('id', '<', $currentBlogId)->orderBy('id', 'desc')->first();
    }

    public function findNextBlog($currentBlogId)
    {
        // Truy vấn blog sau dựa trên ID lớn hơn blog hiện tại, sắp xếp tăng dần
        return Blog::where('id', '>', $currentBlogId)->orderBy('id', 'asc')->first();
    }

    public function getBlogsByCategory($category, $perPage = 6)
    {
        return $this->model->where('category', $category)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
