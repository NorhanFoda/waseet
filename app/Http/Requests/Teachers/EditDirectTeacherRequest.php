<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class EditDirectTeacherRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone_main' => 'required',
            'exper_years' => 'required',
            'age' => 'required',
            'edu_level_id' => 'required',
            'material_ids' => 'required',
            'nationality_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'teaching_address' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
