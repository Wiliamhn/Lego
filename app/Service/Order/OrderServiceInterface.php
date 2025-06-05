<?php

namespace App\Service\Order;

use App\Service\ServiceInterface;

interface OrderServiceInterface extends ServiceInterface
{
    public function getOrderByUserId($userId);
    public function getBestSellingProducts($timeFrame);
    public function getTopCustomersByRevenue($timeFrame, $search);
}
