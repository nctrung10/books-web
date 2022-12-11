<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapDanhMuc extends FormRequest
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
            'tenDM'=> 'required|unique:danhmucsanpham',
        ];
    }
    public function messages()
    {
        return [
            'tenDM.unique' => 'Tên danh mục đã tồn tại',
            'tenDM.required' => 'Tên danh mục không được để trống',
        ];
    }
}
