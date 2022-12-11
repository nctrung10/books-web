<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RuleDangKy extends FormRequest
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
            'emailKH' => 'required|unique:khachhang,email',
            'sdtKH' => 'required|unique:khachhang',
            'matkhau' => 'required|min:3|max:20',
            'xacnhan' => 'required|same:matkhau',
        ];
    }

    public function messages()
    {
        return [
            'matkhau.required' => 'Mật khẩu không được để trống',
            'matkhau.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'matkhau.max' => 'Mật khẩu phải tối đa 20 ký tự',
            'xacnhan.required' => 'Xác nhận mật khẩu không được để trống',
            'xacnhan.same' => 'Mật khẩu không khớp',
            'emailKH.unique' => 'Email đã có người đăng ký',
            'sdtKH.unique' => 'Số điện thoại đã có người đăng ký',

        ];
    }
}
