<?php

namespace App\Http\Requests\Bags;

use Illuminate\Foundation\Http\FormRequest;

class EditBagCategoryRequest extends FormRequest
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
            'name_ar' =>'required',
            'name_en' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
