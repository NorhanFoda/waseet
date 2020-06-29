<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'work_hours' => 'required',
            'exper_years' => 'required',
            'address' => 'required',
            'required_number' => 'required',
            'free_places' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'required_age' => 'required',
            'salary' => 'required',
            'country_id' => 'required',
            'city_ids' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
