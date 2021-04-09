<?php


namespace Ocart\Ecommerce\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'    => 'required|max:120',
            'symbol'    => 'required|max:120',
            'exchange_rate' => 'numeric',
            'decimals' => 'integer',
        ];
    }
}
