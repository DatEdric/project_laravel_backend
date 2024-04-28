<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'b_name' => 'required | max:191 ',
            'author' => 'required',
            'b_categories_id' => 'required',
            'b_publishing_company_id' => 'required',
            'b_code_book' => 'required|max:10|unique:books,b_code_book,'.$this->id,

        ];
    }

    public function messages()
    {
        return [
            'b_name.required' => 'Dữ liệu không được phép để trống.',
            'b_name.max' => 'Vượt quá số ký tự cho phép',
            'author.required' => 'Dữ liệu không được phép để trống.',
            'b_categories_id.required' => 'Dữ liệu không được phép để trống.',
            'b_publishing_company_id.required' => 'Dữ liệu không được phép để trống.',
            'b_code_book.required' => 'Dữ liệu không được phép để trống.',
            'b_code_book.unique' => 'Vượt quá số ký tự cho phép',
        ];
    }
}
