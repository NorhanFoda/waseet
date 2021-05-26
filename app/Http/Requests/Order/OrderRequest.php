<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'carts' => 'required|array',
            'carts.*.id' => 'required',
            "carts.*.bag_id" => 'required',
            "carts.*.quantity" => 'required',
            "carts.*.total_price" => 'required',
            // "carts.*.buy_type" => 'required',
            'buy_type' => 'required',
            'address_id' => 'required_if:buy_type,2',
            'payment_method_id' => 'required'
        ];
    }
}
