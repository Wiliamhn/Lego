<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoriesInterface;

interface OrderRepositoryInterface extends RepositoriesInterface
{
    public function getOrderByUserId($userId);
    public function getBestSellingProducts($timeFrame);
    public function getTopCustomersByRevenue($timeFrame, $search);
}
