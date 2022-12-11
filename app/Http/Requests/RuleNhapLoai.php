<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapLoai extends FormRequest
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
            'tenLoai'=> 'required|unique:loaisach',
        ];
    }
    public function messages()
    {
        return [
            'tenLoai.unique' => 'Tên loại sách đã tồn tại',
            'tenLoai.required' => 'Tên loại sách không được để trống',
        ];
    }
}
