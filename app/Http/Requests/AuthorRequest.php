<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'at_name' => 'required | max:191',
            'at_email' => 'required | max:191 | email |unique:authors,at_email,'.$this->id,
            'at_gender' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'at_name.required' => 'Dữ liệu không được phép để trống.',
            'at_name.max' => 'Vượt quá số ký tự cho phép',
            'at_email.required' => 'Dữ liệu không được phép để trống.',
            'at_email.max' => 'Vượt quá số ký tự cho phép',
            'at_email.unique' => 'Dữ liệu đã bị trùng',
            'at_email.email' => 'Định dạng dữ liệu không chuẩn xác',
            'at_gender.required' => 'Dữ liệu không được phép để trống.',
        ];
    }
}
