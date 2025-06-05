<?php

namespace App\Repositories\ProductView;

use App\Repositories\RepositoriesInterface;
interface ProductViewRepositoryInterface extends RepositoriesInterface
{
    public function getTopViewedProducts($timeFrame);
}
