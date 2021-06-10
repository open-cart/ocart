<?php

namespace Ocart\Attribute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ocart\Ecommerce\Models\Product;

class ProductVariationCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'sku'    => [
                'max:120',
                Rule::unique((new Product)->getTable())
            ],
        ];
    }
}