<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{


    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/customer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //nếu đã đăng nhập bằng khách hàng thì đoạn này sẽ chuyển hướng về dashbroand khách hàng
        $this->middleware(['guest', 'guest:admin'])->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'email' => [
                    'required',
                    'max:255',
                    Rule::exists('users')->where(function ($query) {
                        $query->where('status', 1);
                    }),
                ],
                'password' => 'required',
            ],
            [
                'email.required' => 'vui lòng nhập tên đăng nhập của bạn',
                'email.max' => 'Độ dài tối đa của Tên đăng nhập là 255',
                'email.exists' => 'Tài khoản của bạn đã bị vô hiệu hóa hoặc không tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu của bạn',
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('customer'));
        }
        return redirect(route('login'))->withErrors(['email' => 'Tài Khoản Hoặc Mật Khẩu Không Chính Xác', 'password' => ' '])->withInput();
    }
}
