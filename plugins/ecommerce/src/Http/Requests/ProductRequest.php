<?php


namespace Ocart\Ecommerce\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|max:120',
            'description' => 'max:400',
            'content' => 'required',
            'sku'    => 'required|max:120',
        ];
    }
}
