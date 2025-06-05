<?php

namespace App\Service\DiscountCode;


use App\Repositories\DiscountCode\DiscountCodeRepositoryInterface;
use App\Service\BaseService;


class DiscountCodeService extends BaseService implements DiscountCodeServiceInterface
{
    public $repository;

    public function __construct(DiscountCodeRepositoryInterface $DiscountCodeRepository)
    {
        $this->repository = $DiscountCodeRepository;
    }

    public function getDiscountByCode($code)
    {
        return $this->repository->getDiscountByCode($code);
    }

}
