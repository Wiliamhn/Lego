<?php

namespace App\Service\ProductView;




use App\Service\ServiceInterface;

interface ProductViewServiceInterface extends ServiceInterface
{
    public function getTopViewedProducts($timeFrame);

}
