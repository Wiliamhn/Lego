<?php

namespace App\Service\DiscountCode;




use App\Service\ServiceInterface;

interface DiscountCodeServiceInterface extends ServiceInterface
{
    public function getDiscountByCode($code);
}
