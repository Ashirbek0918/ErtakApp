<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGetRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'device_key' => ['required','exists:users,device_key'],
        ];
    }
    public function messages()
    {
        return [
            'device_key.required' =>" Device key yuborilishi shart",
            'device_key.exists' => "Yuborilgan device_key oldin xabar yuborgan bo'lishi shart"
        ];
    }
}
