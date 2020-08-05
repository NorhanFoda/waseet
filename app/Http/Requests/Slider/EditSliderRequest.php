<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class EditSliderRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'body_ar' => 'required',
            'body_en' => 'required',
            'image' => 'sometimes|image||mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
