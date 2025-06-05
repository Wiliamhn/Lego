<?php

namespace App\Repositories\Supplier;


use App\Models\Supplier;
use App\Repositories\BaseRepositories;
class SupplierRepository extends BaseRepositories implements SupplierRepositoryInterface
{
    public function getModel()
    {
        return Supplier::class;
    }
}