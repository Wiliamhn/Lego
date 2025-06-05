<?php

namespace App\Repositories\DiscountCode;


use App\Models\DiscountCode;
use App\Repositories\BaseRepositories;

class DiscountCodeRepository extends BaseRepositories implements DiscountCodeRepositoryInterface
{
    public function getModel()
    {
        return DiscountCode::class;
    }
    public function getDiscountByCode($code)
    {
        return DiscountCode::where('code', $code)
            ->where('expired_at', '>=', now()) // Kiểm tra mã giảm giá còn hiệu lực
            ->first();
    }
}
