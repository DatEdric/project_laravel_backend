<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishingCompanyRequest extends FormRequest
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
            'pc_name' => 'required | max:191',
            'pc_email' => 'required | max:191 | email |unique:publishing_company,pc_email,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'pc_name.required' => 'Dữ liệu không được phép để trống.',
            'pc_name.max' => 'Vượt quá số ký tự cho phép',
            'pc_email.required' => 'Dữ liệu không được phép để trống.',
            'pc_email.max' => 'Vượt quá số ký tự cho phép',
            'pc_email.unique' => 'Dữ liệu đã bị trùng',
            'pc_email.email' => 'Định dạng dữ liệu không chuẩn xác',
        ];
    }
}
