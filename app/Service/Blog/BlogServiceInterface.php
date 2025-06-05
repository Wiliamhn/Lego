<?php

namespace App\Service\Blog;

use App\Service\ServiceInterface;

interface BlogServiceInterface extends ServiceInterface
{
    public function getLatestBlogs($limit = 3);
     public function findPreviousBlog($currentBlogId);
    public function findNextBlog($currentBlogId);
    public function getBlogsByCategory($category);

}
