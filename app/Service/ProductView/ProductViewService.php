<?php

namespace App\Service\ProductView;


use App\Repositories\ProductView\ProductViewRepositoryInterface;
use App\Service\BaseService;


class ProductViewService extends BaseService implements ProductViewServiceInterface
{
    public $repository;

    public function __construct(ProductViewRepositoryInterface $productViewRepository)
    {
        $this->repository = $productViewRepository;
    }
    public function getTopViewedProducts($timeFrame)
    {
        return $this->repository->getTopViewedProducts($timeFrame);
    }
}
