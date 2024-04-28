<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReaderRequest extends FormRequest
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
            'r_name' => 'required | max:191 ',
            'r_gender' => 'required',
            'r_birthday' => 'required',
            'r_code_card' => 'nullable|max:10|unique:reader,r_code_card,'.$this->id,
            'images' => 'nullable|image|max:9072',
        ];
    }

    public function messages()
    {
        return [
            'r_name.required' => 'Dữ liệu không được phép để trống.',
            'r_name.max' => 'Vượt quá số ký tự cho phép',
            'r_gender.required' => 'Dữ liệu không được phép để trống.',
            'r_birthday.required' => 'Dữ liệu không được phép để trống.',
            'r_code_card.required' => 'Dữ liệu không được phép để trống.',
            'r_code_card.unique' => 'Dữ liệu đã bị trùng',
            'images.image' => 'Định dạng không phù hợp',
            'images.max' => 'Quá dung lượng cho phép',
        ];
    }
}
