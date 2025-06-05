<?php

namespace App\Repositories\DiscountCode;

use App\Repositories\RepositoriesInterface;
interface DiscountCodeRepositoryInterface extends RepositoriesInterface
{
    public function getDiscountByCode($code);
}
