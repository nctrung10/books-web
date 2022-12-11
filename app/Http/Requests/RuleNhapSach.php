<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapSach extends FormRequest
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
            'tenSach'=> 'required|unique:sach',
        ];
    }
    public function messages()
    {
        return [
            'tenSach.unique' => 'Tên sách đã tồn tại',
            'tenSach.required' => 'Tên loại sách không được để trống',
        ];
    }
}
