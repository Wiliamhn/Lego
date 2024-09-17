<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    protected $orderService;
    protected $orderDetailService;
    public function __construct(OrderServiceInterface $orderService,
                                OrderDetailServiceInterface $orderDetailService){
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index' , compact('carts','total','subtotal'));
    }

    public function addOrder(Request $request){
        // Thêm đơn hàng
        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;
        $order =  $this->orderService->create($data);

        //Thêm chi tiết đơn hàng
        $carts = Cart::content();
        foreach($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->qty*$cart->price,
            ] ;


            $this->orderDetailService->create($data);
        }
        if($request->payment_type == 'pay_later'){
             //gửi email
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order,$total,$subtotal); // Gọi hàm gửi email

            //Xóa giỏ hàng
            Cart::destroy();

            //Trả về kết quả thông báo
            return redirect('checkout/result')
                ->with('notification','Cảm ơn đã mua hàng, vùi lòng kiểm tra email.');
        }
        if($request->payment_type == 'online_payment'){
            // lấy url thanh toán vnpay
            $data_url = VNPay::vnpay_create_payment([
               'vnp_TxnRef' => $order->id, //Id đơn hàng
                'vnp_OrderInfo' => 'Mô tả đơn hàng', // Mô tả đơn hàng
                'vnp_Amount' => Cart::total(0,'','') * 25015, // giá tiền việt

            ]);

            // chuyển tới url lấy đc
            return redirect()->to($data_url);

        }

    }

    public function vnPayCheck(Request $request)
    {
        // lấy dữ liệu từ url(do vnpay gửi vè qua $vnp_Returnurl)
        $vpn_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vpn_Amount = $request->get('vnp_Amount');
        // kiểm tra dữ liệu
        if($vpn_ResponseCode != null){
            //nếu thành công
            if($vpn_ResponseCode == '00'){
                //Cập nhật trạng thái Order:
                $this->orderService->update(['status' => Constant::order_status_Paid], $vnp_TxnRef);

                //xóa giỏ hàng
                Cart::destroy();


                return redirect('checkout/result')
                    ->with('notification','Cảm ơn đã mua hàng, vùi lòng kiểm tra email.');
            }else{//nếu k thành công
                // xóa đơn hàng đã thêm
                $this->orderService->delete($vnp_TxnRef);


                //thông báo lỗi
                return redirect('checkout/result')
                    ->with('notification','Lỗi, đơn hàng của bạn đã bị hủy.');
            }

        }
    }


    public function result(Request $request){
        $notification = session('notification');

        return view('front.checkout.result', compact('notification'));
    }

    private function sendEmail($order, $total, $subtotal)
    {
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'),
            function ($message) use ($email_to) {
            $message->from('ngoccu1945@gmail.com','Lego Store');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }
}
