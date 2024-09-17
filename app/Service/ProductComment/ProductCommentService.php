<?php

namespace App\Service\ProductComment;

use App\Models\ProductComment;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Service\BaseService;

class ProductCommentService extends BaseService implements ProductCommentServiceInterface
{
    public $repository;
    public function __construct(ProductCommentRepository $ProductCommentRepository){
        $this->repository = $ProductCommentRepository;
    }


}
