<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapNXB extends FormRequest
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
            'tenNXB'=> 'required|unique:nhaxuatban',
            'emailNXB'=> 'required|unique:nhaxuatban',
        ];
    }

    public function messages()
    {
        return [
            'tenNXB.unique' => 'Tên nhà xuất bản đã tồn tại',
            'emailNXB.unique' => 'Email nhà xuất bản đã tồn tại',
        ];
    }

}
