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
        $rules = [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'phone_main' => 'required_if:role_id,2|required_if:role_id,3|required_if:role_id,4|required_if:role_id,5|required_if:role_id,6|min:9|max:14|unique:users,phone_main,'.auth()->user()->id,
            // 'phone_secondary' => 'sometimes|min:9|max:14',
            'exper_years' => 'required_if:role_id,3|required_if:role_id,4|required_if:role_id,6',
            // 'age' => 'required_if:role_id,2|required_if:role_id,3|required_if:role_id,4|required_if:role_id,6',

            'stage_id' => 'required_if:role_id,2',
            'other_stage' => 'required_if:stage_id,4',

            'edu_level_id' => 'required_if:role_id,3|required_if:role_id,4',
            'other_edu_level' => 'required_if:edu_level_id,4',

            'material_ids' => 'array|required_if:role_id,3|required_if:role_id,4',
            'bio_ar' => 'required_if:role_id,3|required_if:role_id,4',
            'bio_en' => 'required_if:role_id,3|required_if:role_id,4',

            // 'nationality_id' => 'required_if:role_id,3|required_if:role_id,4',
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
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000',

            'edu_type_id' => 'required_if:role_id,5',
            'other_edu_type' => 'required_if:edu_type_id,4',
            
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if(isset(request()->material_ids))
        {
            if(in_array('4',request()->material_ids))
            {
            $additionalRules = [
                'other_material' =>  'required',
            ];
            $rules = $rules + $additionalRules;
            }
        }

        return $rules;
    }
}
