<?php

namespace App\Service\blogComment;


use App\Repositories\blogComment\blogCommentRepositoryInterface;
use App\Service\BaseService;



class blogCommentService extends BaseService implements blogCommentServiceInterface
{
    public $repository;

    public function __construct(blogCommentRepositoryInterface $blogCommentRepository)
    {
        $this->repository = $blogCommentRepository;
    }

}