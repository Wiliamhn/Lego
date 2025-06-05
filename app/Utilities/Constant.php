<?php

namespace App\Utilities;

class Constant
{
    // Các hằng số role dùng chung toàn bộ hệ thống

    //Order
    const order_status_ReceiveOrders = 1;
    const order_status_Unconfirmed = 2;
    const order_status_Confirmed = 3;
    const order_status_Paid = 4;
    const order_status_Processing = 5;
    const order_status_Shipping = 6;
    const order_status_Finish = 7;
    const order_status_Cancel = 0;
    
    public static $order_status = [
        self::order_status_ReceiveOrders => 'Đã nhận đơn',
        self::order_status_Unconfirmed => 'Chưa xác nhận',
        self::order_status_Confirmed => 'Đã xác nhận',
        self::order_status_Paid => 'Đã thanh toán',
        self::order_status_Processing => 'Đang xử lý',
        self::order_status_Shipping => 'Đang giao hàng',
        self::order_status_Finish => 'Hoàn tất',
        self::order_status_Cancel => 'Đã hủy',
    ];

    //User
    const user_level_host = 0;
    const user_level_admin = 1;
    const user_level_client = 2;
    public static $user_level = [
        self::user_level_host => 'host',
        self::user_level_admin => 'admin',
        self::user_level_client => 'client',
    ];

}
