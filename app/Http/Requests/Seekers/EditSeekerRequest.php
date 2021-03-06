<?php

namespace App\Http\Requests\Seekers;

use Illuminate\Foundation\Http\FormRequest;

class EditSeekerRequest extends FormRequest
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
            'phone_main' => 'required|min:9|max:11',
            'exper_years' => 'required',
            'age' => 'required',
            // 'country_id' => 'required',
            // 'city_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'salary_month' => 'required',
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000',
        ];
    }
}
