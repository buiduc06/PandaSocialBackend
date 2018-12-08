<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminLoginController extends Controller
{

    // use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //nếu đã đăng nhập bằng admin thì đoạn này sẽ chuyển hướng về dashbroand admin
        $this->middleware(['guest:admin', 'guest'])->except('logout');
    }

    public function index()
    {
        return view('customer.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'email' => 'required|max:255',
                'password' => 'required',
            ],
            [
                'email.required' => 'vui lòng nhập Địa chỉ Email của bạn',
                'email.max' => 'Độ dài tối đa của Địa chỉ Email là 255',
                'password.required' => 'Vui lòng nhập mật khẩu của bạn',
            ]
        );
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin'));
        }


        return redirect(route('admin.login'))->withErrors(['email' => 'Tài Khoản Hoặc Mật Khẩu Không Chính Xác', 'password' => ' '])->withInput();
    }
}
