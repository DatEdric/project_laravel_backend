<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'password' => 'required | max:191 ',
            'rpassword' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập vào mật khẩu',
            'rpassword.required' => 'Vui lòng nhập lại mật khẩu',
            'rpassword.same'    => 'Mật khẩu không trùng khớp',
        ];
    }
}
