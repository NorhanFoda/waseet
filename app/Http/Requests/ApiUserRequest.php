<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiUserRequest extends FormRequest
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
            'phone_main' => 'required_if:role_id,2|required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6|unique:users',
            'password' => 'required|min:9|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:9',
            'exper_years' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,6',
            'age' => 'required_if:role_id,2|required_if:role_id,3|required_if:role_id,4|required_if:role_id,6',

            'stage_id' => 'required_if:role_id,2',
            'other_stage' => 'required_if:stage_id,4',

            'edu_level_id' => 'required_if:role_id,3|required_if:role_id,4|required_if:other_edu_level,null',
            'other_edu_level' => 'required_if:edu_level_id,4',


            'material_ids' => 'array|required_if:role_id,3|required_if:role_id,4',
            'bio_ar' => 'required_if:role_id,3|required_if:role_id,4',
            'bio_en' => 'required_if:role_id,3|required_if:role_id,4',

            'nationality_id' => 'required_if:role_id,3|required_if:role_id,4|required_if:other_nationality,null',
            'other_nationality' => 'required_if:nationality_id,3',

            // 'country_id' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            // 'city_id' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'address' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'lat' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'long' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6',
            'teaching_lat' => 'required_if:role_id,3',
            'teaching_long' => 'required_if:role_id,3',
            'teaching_address' => 'required_if:role_id,3',

            'teaching_method' => 'required_if:role_id,4',

            'salary' => 'required_if:role_id,6',
            'cv' => 'required_if:role_id,6|mimetypes:application/pdf|max:10000',

            'edu_type_id' => 'required_if:role_id,5|required_if:other_edu_type,null',
            'other_edu_type' => 'required_if:edu_type_id,4',

            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
