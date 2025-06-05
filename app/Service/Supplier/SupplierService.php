<?php

namespace App\Service\Supplier;


use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Service\BaseService;


class SupplierService extends BaseService implements SupplierServiceInterface
{
    public $repository;

    public function __construct(SupplierRepositoryInterface $SupplierRepository)
    {
        $this->repository = $SupplierRepository;
    }

}