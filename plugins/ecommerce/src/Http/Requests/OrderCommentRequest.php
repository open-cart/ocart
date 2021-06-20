<?php


namespace Ocart\Ecommerce\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment'    => 'required',
            'order_id' => [
                'required',
                Rule::exists('ecommerce_orders', 'id')
            ],
        ];
    }
}
