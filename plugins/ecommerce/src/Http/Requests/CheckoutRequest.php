<?php

namespace Ocart\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|min:8|max:12',
            'email' => 'required|string|email|max:255',
            'address' => 'required',
        ];
    }

}