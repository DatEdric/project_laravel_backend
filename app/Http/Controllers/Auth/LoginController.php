<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //    public function __construct()
    //    {
    //        $this->middleware('guest')->except('logout');
    //    }

    public function getLogin()
    {

        //$this->middleware('guest')->except('logout');
    }

    /*
     * load view login
     */
    public function login()
    {

        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }

    /*
     * post login
     */

    public function postLogin(LoginRequest $request)
    {
        $user['email'] = $request->email;
        $user['password'] = $request->password;

        $dataUser = User::where('email', $request->email)->first();

        if (!$dataUser) {
            return redirect()->back()->with('danger', 'Thông tin tài khoản không chính xác');
        }

        if ($dataUser->status == User::STATUS_LOCKED) {
            return redirect()->back()->with('danger', 'Tài khoản của bạn đã bị khóa, vui lòng liên hệ với quản trị viên của bạn.');
        }

        $remember = $request->remember_token;

        if (Auth::attempt($user, $remember)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('danger', 'Tên người dùng hoặc mật khẩu không chính xác');
        }
    }

    /*
     * logout
     */

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
