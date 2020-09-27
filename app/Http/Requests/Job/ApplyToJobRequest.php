<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class ApplyToJobRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'phone_main' => 'required|unique:users,phone_main,'.auth()->user()->id,
            'phone_secondary' => 'sometimes',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'job_id' => 'required',
            'exper_years' => 'required',
            'salary' => 'required',
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000'
        ];
    }
}
