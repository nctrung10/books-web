<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapNV extends FormRequest
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

            'password' => 'required|min:8|max:20',
            'cf_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu phải tối đa 20 ký tự',
            'cf_password.same' => 'Mật khẩu không khớp',
            'rate.required' => 'Vui lòng chọn số sao',
            'binhLuan.required' => 'Vui lòng nhập bình luận',
            
       ];
    }
}
