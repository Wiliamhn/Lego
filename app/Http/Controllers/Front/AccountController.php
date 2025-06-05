<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Service\Order\OrderServiceInterface;
use App\Service\User\UserService;
use App\Service\User\UserServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Utilities\Common;

class AccountController extends Controller
{
    private $userService;
    private $orderService;

    public function __construct(
        UserServiceInterface $userService,
        OrderServiceInterface $orderService
    ) {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    public function login()
    {
        return view('front.account.login');
    }
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin user hiện tại
        return view('front.account.edit', compact('user'));
    }
   public function update(Request $request)
{
    $user = Auth::user(); // Lấy user hiện tại

    $data = $request->all();

    // Xử lý mật khẩu
    if ($request->get('password') != null) {
        if ($request->get('password') != $request->get('password_confirmation')) {
            return back()
                ->with('notification', 'Mật khẩu chưa đúng !')
                ->withInput();
        }
        $data['password'] = bcrypt($request->get('password'));
    } else {
        unset($data['password']);
    }

    // Xử lý ảnh
    if ($request->hasFile('image')) {
        $data['avatar'] = Common::uploadFile($request->file('image'), 'front1/img/user');

        $file_name_old = $request->get('image_old');
        $old_path = public_path('front1/img/user/' . $file_name_old);
        if ($file_name_old != '' && file_exists($old_path)) {
            unlink($old_path);
        }
    }

    $this->userService->update($data, $user->id); // Cập nhật user hiện tại

    return redirect()->route('home')->with('notification', 'Cập nhật thông tin thành công!');
}





    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::user_level_client, // tạo tài khoản cap khách hàng
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            // return redirect('');
            return redirect()->intended(''); // mặc định là trang chủ
        } else {
            return back()->with('notification', 'Thông tin đăng nhập sai');
        }
    }
    public function logout()
    {
        Auth::logout();

        return back();
    }
    public function register()
    {
        return view('front.account.register');
    }

    public function postRegister(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with('notification', 'Sai mật khẩu nhập lại!');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::user_level_client, // tạo tài khoản cap khách hàng

        ];

        $this->userService->create($data);
        return redirect('account/login')
            ->with('notification', 'Đăng kí thành công, hãy đăng nhập');
    }


    public function myOrderIndex()
    {
        $orders = $this->orderService->getOrderByUserId(Auth::id());


        return view('front.account.my-order.index', compact('orders'));
    }

    public function myOrderShow($id)
    {
        $order = $this->orderService->find($id);

        return view('front.account.my-order.show', compact('order'));
    }
    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $findUser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();



        if (!is_null($findUser)) {
            Auth::login($findUser);
        } else {
            $findUser = User::create([
                "name" => $user->name,
                "email" => $user->email,
                "google_id" => $user->id,
                'password' => encrypt('123456'),
                'level' => Constant::user_level_client,
                'first_name' => '',
                'last_name' => ''
            ]);
            Auth::login($findUser);
        }

        return redirect('');
    }
    public function forgotPasswordForm()
    {
        return view('front.account.forgotPasswordForm');
    }
    public function forgotPasswordFormPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(65);

        DB::table('password_resets')->insert([
            "email" => $request->email,
            "token" => $token,
            "created_at" => now()
        ]);

        Mail::send('front.account.forgotPassword', ['token' => $token], function ($message) use ($request) {
            $message->from('minhchoigame275@gmail.com', 'Minh Quang'); // Thêm dòng này
            $message->to($request->email);
            $message->subject('Forgot Password');
        });

        // Sử dụng session()->flash để hiển thị thông báo
        session()->flash('success', 'Check your email for instructions on reset password!');

        return redirect()->route('account.login');
    }
    public function showLinkForm($token)
    {
        return view('front.account.forgotPasswordLinkForm', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            "token" => "required",
            "email" => "required|email|exists:users",
            "password" => "required|confirmed",
        ]);

        $first = DB::table('password_resets')->where("email", $request->email)
            ->where("token", $request->token)
            ->first();

        if (is_null($first)) {
            return back()->with('error', 'Something went wrong!');
        }

        $user = User::where("email", $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where("email", $request->email)
            ->where("token", $request->token)
            ->delete();

        return redirect()->route('account.login')->with('success', 'Your password has been changed!');
    }
}
