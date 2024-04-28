<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required | max:191',
            'email' => 'required | max:191 | email |unique:users,email,'.$this->id,
            'password' => 'required | max:191 ',
            'role'  => 'required',
            'status'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Dữ liệu không được phép để trống.',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'email.required' => 'Dữ liệu không được phép để trống.',
            'email.max' => 'Vượt quá số ký tự cho phép',
            'email.unique' => 'Dữ liệu đã bị trùng',
            'email.email' => 'Định dạng dữ liệu không chuẩn xác',
            'password.required' => 'Dữ liệu không được phép để trống.',
            'role.required' => 'Dữ liệu không được phép để trống.',
            'status.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}
