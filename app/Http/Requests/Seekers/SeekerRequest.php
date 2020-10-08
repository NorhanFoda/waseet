<?php

namespace App\Http\Requests\Seekers;

use Illuminate\Foundation\Http\FormRequest;

class SeekerRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone_main' => 'required|min:9|max:11|unique:users,phone_main',
            'password' => 'min:9|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:9',
            'exper_years' => 'required',
            'age' => 'required',
            // 'country_id' => 'required',
            // 'city_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'salary_month' => 'required',
            'cv' => 'required|mimetypes:application/pdf|max:10000',
        ];
    }
}
