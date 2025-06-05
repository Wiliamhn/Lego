<?php


namespace App\Utilities;


class VNPay
{
    /**
     * Cấu hình
     *
     * config.php
     *
     */
    static $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    static $vnp_Returnurl = "/checkout/vnPayCheck"; //Chú ý cấu hình env('APP_URL') khi sử dụng biến này.
    static $vnp_TmnCode = "CPEXO26G"; //Mã website tại VNPAY
    static $vnp_HashSecret = "IEX7XWHHF1OPC9DWJUB1Y80OQGVGAYTX"; //Chuỗi bí mật



    /**
     * vnpay_create_payment.php
     *
     * https://sandbox.vnpayment.vn/apis/docs/huong-dan-tich-hop
     *
     * @param array $data
     * [ <br>
     * vnp_TxnRef => ' ', //Mã tham chiếu của giao dịch tại hệ thống của merchant. Mã này là duy nhất đùng để phân biệt các đơn hàng gửi sang VNPAY. Không được trùng lặp trong ngày. Ví dụ: 23554 <br> <br>
     * vnp_OrderInfo => ' ', //Thông tin mô tả nội dung thanh toán (Tiếng Việt, không dấu). Ví dụ: **Nap tien cho thue bao 0123456789. So tien 100,000 VND** <br> <br>
     * vnp_Amount => ' ', Số tiền thanh toán. Số tiền không mang các ký tự phân tách thập phân, phần nghìn, ký tự tiền tệ. Để gửi số tiền thanh toán là 10,000 VND (mười nghìn VNĐ) thì merchant cần nhân thêm 100 lần (khử phần thập phân), sau đó gửi sang VNPAY là: 1000000 <br>
     * ]
     *
     * @return string
     */
    public static function vnpay_create_payment(array $data)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

        // Lấy các tham số
        $vnp_TxnRef = $data['vnp_TxnRef']; // Mã đơn hàng duy nhất
        $vnp_OrderInfo = $data['vnp_OrderInfo'];
        $vnp_Amount = $data['vnp_Amount'] * 100; // VNPay yêu cầu số tiền phải nhân với 100
        $vnp_Locale = 'vn'; // Ngôn ngữ
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => self::$vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND", // Đơn vị tiền tệ VNPay yêu cầu
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => 100000, // Loại đơn hàng (có thể thay đổi tùy vào yêu cầu)
            "vnp_ReturnUrl" => env('APP_URL') . self::$vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        // Nếu có mã ngân hàng, thêm vào
        if (isset($data['vnp_BankCode']) && $data['vnp_BankCode'] != "") {
            $inputData['vnp_BankCode'] = $data['vnp_BankCode'];
        }

        // Sắp xếp các tham số theo thứ tự bảng chữ cái
        ksort($inputData);

        // Chuỗi hash
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Tính toán chữ ký bảo mật
        $vnp_Url = self::$vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, self::$vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return $vnp_Url; // Trả về URL đầy đủ
    }


}

// Thẻ test:
//Ngân hàng: NCB
//Số thẻ: 9704198526191432198
//Tên chủ thẻ:NGUYEN VAN A
//Ngày phát hành:07/15
//Mật khẩu OTP:123456
