<?php


namespace Ocart\Contact\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ocart\Contact\Enums\ContactStatusEnum;

class ContactRequest extends FormRequest
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
            'content' => 'required',
            'status'    => Rule::in(ContactStatusEnum::toArray()),
        ];
    }
}
