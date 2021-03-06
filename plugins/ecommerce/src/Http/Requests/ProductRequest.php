<?php


namespace Ocart\Ecommerce\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ocart\Ecommerce\Models\Product;

class ProductRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $sku = $this->input('sku') ?: create_sku();

        $this->merge(['sku' => $sku]);
    }

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
            'sku'    => [
                'required',
                'max:120',
                Rule::unique((new Product)->getTable())
            ],
        ];
    }
}
