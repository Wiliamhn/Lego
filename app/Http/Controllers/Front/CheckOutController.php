<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Service\Product\ProductServiceInterface; // Thêm service quản lý product
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class CheckOutController extends Controller
{
    protected $orderService;
    protected $orderDetailService;
    protected $productService;

    public function __construct(
        OrderServiceInterface $orderService,
        OrderDetailServiceInterface $orderDetailService,
        ProductServiceInterface $productService // Inject service product
    ){
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->productService = $productService;
    }

    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index' , compact('carts','total','subtotal'));
    }

    public function addOrder(Request $request){
        DB::beginTransaction();
        try {
            // Thêm đơn hàng
            $data = $request->all();
            $data['status'] = Constant::order_status_ReceiveOrders;
            $order = $this->orderService->create($data);

            // Thêm chi tiết đơn hàng và trừ số lượng trong kho
            $carts = Cart::content();
            foreach($carts as $cart){
                $orderDetailData = [
                    'order_id' => $order->id,
                    'product_id' => $cart->id,
                    'qty' => $cart->qty,
                    'amount' => $cart->price,
                    'total' => $cart->qty * $cart->price,
                ];

                $this->orderDetailService->create($orderDetailData);

                // Trừ số lượng sản phẩm trong kho
                $product = $this->productService->find($cart->id);
                if (!$product) {
                    throw new \Exception("Sản phẩm không tồn tại");
                }

                if ($product->qty < $cart->qty) {
                   return redirect()->back()->with('notification', 'Số lượng sản phẩm không đủ trong kho: ' . $product->name);

                }

                $newQty = $product->qty - $cart->qty;
                $this->productService->update(['qty' => $newQty], $product->id);
            }

            DB::commit();

            if ($request->payment_type == 'pay_later') {
                // gửi email
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $total, $subtotal);

                // Xóa giỏ hàng
                Cart::destroy();

                return redirect('checkout/result')
                    ->with('notification', 'Cảm ơn đã mua hàng, vui lòng kiểm tra email.');
            }

            if ($request->payment_type == 'online_payment') {
                $data_url = VNPay::vnpay_create_payment([
                    'vnp_TxnRef' => $order->id,
                    'vnp_OrderInfo' => 'Mô tả đơn hàng',
                    'vnp_Amount' => Cart::total(0,'','') * 1,
                ]);
                return redirect()->to($data_url);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }

    public function vnPayCheck(Request $request)
    {
        $vpn_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vpn_Amount = $request->get('vnp_Amount');

        if ($vpn_ResponseCode != null) {
            if ($vpn_ResponseCode == '00') {
                $order = $this->orderService->find($vnp_TxnRef);

                // Cập nhật trạng thái Order:
                $this->orderService->update(['status' => Constant::order_status_Paid], $vnp_TxnRef);

                $total = Cart::total();
                $subtotal = Cart::subtotal();

                $this->sendEmail($order, $total, $subtotal);

                // Xóa giỏ hàng
                Cart::destroy();

                return redirect('checkout/result')
                    ->with('notification', 'Cảm ơn đã mua hàng, vui lòng kiểm tra email.');
            } else {
                $this->orderService->delete($vnp_TxnRef);
                return redirect('checkout/result')
                    ->with('notification', 'Lỗi, đơn hàng của bạn đã bị hủy.');
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

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'), function ($message) use ($email_to) {
            $message->from('ngoccu1945@gmail.com', 'Lego Store');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }
}
