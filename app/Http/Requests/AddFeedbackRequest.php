<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFeedbackRequest extends FormRequest
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
            'voice_id' =>['required','exists:voices,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'feedback' =>['required','string'],
        ];
    }
    public function messages()
    {
        return [
            'voice_id.required' => "Voice id kiritilishi shart",
            'voice_id.exists' => "Mavjud bo'lmagan id ",
            'rating.enum' => "Rating 1-5 oraliqdagi raqam bo'lishi kerak"
        ];
    }
}
