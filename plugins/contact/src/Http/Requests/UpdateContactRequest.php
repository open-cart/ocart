<?php


namespace Ocart\Contact\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ocart\Contact\Enums\ContactStatusEnum;

class UpdateContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'    => Rule::in(ContactStatusEnum::toArray()),
        ];
    }
}
