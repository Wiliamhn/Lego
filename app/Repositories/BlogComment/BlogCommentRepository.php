<?php

namespace App\Repositories\blogComment;


use App\Models\blogComment;
use App\Repositories\BaseRepositories;
class blogCommentRepository extends BaseRepositories implements blogCommentRepositoryInterface
{
    public function getModel()
    {
        return blogComment::class;
    }
}