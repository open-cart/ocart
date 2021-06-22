<?php


namespace Ocart\Payment\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ocart\Payment\Enums\PaymentStatusEnum;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'    => Rule::in(array_values(PaymentStatusEnum::toArray())),
        ];
    }
}
