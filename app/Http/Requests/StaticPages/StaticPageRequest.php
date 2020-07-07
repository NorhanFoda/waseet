<?php

namespace App\Http\Requests\StaticPages;

use Illuminate\Foundation\Http\FormRequest;

class StaticPageRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'short_description_ar' => 'required',
            'short_description_en' => 'required',
            'full_description_ar' => 'required',
            'full_description_en' => 'required',
        ];
    }
}