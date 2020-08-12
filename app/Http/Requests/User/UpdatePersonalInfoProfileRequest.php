<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInfoProfileRequest extends FormRequest
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
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone_main' => 'required_if:role_id,2|required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'exper_years' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,6',
            'age' => 'required_if:role_id,2|required_if:role_id,3|required_if:role_id,4|required_if:role_id,6',
            'stage_id' => 'required_if:role_id,2',
            'edu_level_id' => 'required_if:role_id,3|required_if:role_id,4',
            'material_ids' => 'array|required_if:role_id,3|required_if:role_id,4',
            'bio_ar' => 'required_if:role_id,3|required_if:role_id,4',
            'bio_en' => 'required_if:role_id,3|required_if:role_id,4',
            'nationality_id' => 'required_if:role_id,3|required_if:role_id,4',
            // 'country_id' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            // 'city_id' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'address' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'lat' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'long' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'teaching_lat' => 'required_if:role_id,3',
            'teaching_long' => 'required_if:role_id,3',
            'teaching_address' => 'required_if:role_id,3',
            'salary' => 'required_if:role_id,6',
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000',
            'edu_type_id' => 'required_if:role_id,5',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
