<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapAdmin extends FormRequest
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
            'tenNN' => 'required|unique:ngonngu',
        ];
    }

    public function messages()
    {
        return [
            'tenNN.required' => 'Tên ngôn ngữ không được để trống',
            'tenNN.unique' => 'Tên ngôn ngữ đã tồn tại',
        ];
    }
}
