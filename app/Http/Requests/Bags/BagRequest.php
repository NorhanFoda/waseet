<?php

namespace App\Http\Requests\Bags;

use Illuminate\Foundation\Http\FormRequest;

class BagRequest extends FormRequest
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
            'description_ar' => 'required',
            'description_en' => 'required',
            'contents_ar' => 'required',
            'contents_en' => 'required',
            'benefits_ar' => 'required',
            'benefits_en' => 'required',
            'bag_category_id' => 'required',
            'price' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'poster' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'sometimes|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:20000',
            'documents' => 'array|required_without_all:images,videos',
            'images' => 'array|required_without_all:documents,videos',
            'slider_images' => 'required|array',
            'videos' => 'array|required_without_all:documents,images',
        ];
    }
}
