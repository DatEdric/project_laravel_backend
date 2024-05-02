<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ForgotPasswordRequest;
use App\Helpers\MailHelper;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*
     * hiển thị giao diện quên mật khẩu
     */
    public function forgotPassword()
    {
        return view('backend.auth.forgot-password');
    }

    /*
     * xử lý gửi mật khẩu cho người dùng
     */

    public function postForgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('danger', 'Email does not match any account.');
        }

        try {
            \DB::beginTransaction();
            $user->token = randString(64);
            MailHelper::sendMail($user);
            \DB::table('password_resets')->insert(['email' => $user->email, 'token' => $user->token, 'created_at' => now()]);
            \DB::commit();
            return redirect()->back()->with('success', 'Please check your mail to change your password.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('danger', 'Error occurred which could not process the request');
        }

    }

    public function changePassword($token)
    {
        $data = \DB::table('password_resets')->where('token', $token)->get()->toArray();

        if (empty($data) || !empty($data[0]->updated_at)) {
            return redirect()->route('forgot.password')->with('danger', 'Your request has expired or has been processed');
        }

        return view('backend.auth.update_password');
    }

    public function postChangePassword(ForgotPasswordRequest $request, $token)
    {
        $data = \DB::table('password_resets')->where('token', $token)->first();

        if (!$data) {
            return redirect()->route('forgot.password')->with('danger', 'Your request has expired or has been processed');
        }
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            return redirect()->route('forgot.password')->with('danger', 'Your request has expired or has been processed');
        }
        $password = bcrypt($request->rpassword);

        try {
            \DB::table('password_resets')->where('token', $token)->update(['updated_at' => now()]);
            \DB::table('users')->where('id', $user->id)->update(['password' => $password]);
            return redirect()->route('login')->with('success', 'Change password successfully, please login');
        } catch (\Exception $exception) {
            return redirect()->route('forgot.password')->with('danger', 'Your request has expired or has been processed');
        }
    }
}
