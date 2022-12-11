<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class RuleNhapKM extends FormRequest
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
            'id_DM_GG'=> 'required|unique:giamgia',
        ];
    }

    public function messages()
    {
        return [
            'id_DM_GG.unique' => 'Danh mục đã tồn tại khuyến mãi',
            'id_DM_GG.required' => 'Danh mục không được để trống',
        ];
    }
}
