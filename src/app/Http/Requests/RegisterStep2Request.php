<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'latest_weight' => ['required', 'numeric', 'min:0'],
            'target_weight' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'latest_weight.required' => '現在の体重を入力してください',
            'latest_weight.numeric'  => '現在の体重は数値で入力してください',
            'latest_weight.min'      => '現在の体重は0以上で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric'  => '目標の体重は数値で入力してください',
            'target_weight.min'      => '目標の体重は0以上で入力してください',
        ];
    }
}
