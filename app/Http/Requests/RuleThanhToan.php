<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleThanhToan extends FormRequest
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
            'httt' => 'required',
            'hoTenKH' => 'required',
            'sdtKH' => 'required',
            'email' => 'required',
            'diaChiKH' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'httt.required' => 'Vui lòng chọn hình thức thanh toán',
            'hoTenKH.required' => 'Không được bỏ trống',
            'sdtKH.required' => 'Không được bỏ trống',
            'email.required' => 'Không được bỏ trống',
            'diaChiKH.required' => 'Không được bỏ trống',
        ];
    }
}
