<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateInforProfileRequest extends FormRequest
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
            'name' => 'required | max:191',
            'email' => 'required|email|unique:users,email,'.$this->id,
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
        ];
    }

}
