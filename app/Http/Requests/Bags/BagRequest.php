<?php

namespace App\Http\Requests\Bags;

use Illuminate\Foundation\Http\FormRequest;

class BagRequest extends FormRequest
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
            'description_ar' => 'required',
            'description_en' => 'required',
            'contents_ar' => 'required',
            'contents_en' => 'required',
            'benefits_ar' => 'required',
            'benefits_en' => 'required',
            'bag_category_id' => 'required',
            'price' => 'required',
        ];
    }
}
