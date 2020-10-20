<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DirectTeacherRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_main' => 'required|min:9|max:11|unique:users,phone_main',
            'password' => 'min:9|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:9',
            'exper_years' => 'required',
            'age' => 'required',
            'edu_level_id' => 'required',
            'material_ids' => 'required',
            'nationality_id' => 'required',
            // 'country_id' => 'required',
            // 'city_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'teaching_lat' => 'required',
            'teaching_long' => 'required',
            'teaching_address' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
