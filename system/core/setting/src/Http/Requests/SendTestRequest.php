<?php
namespace Ocart\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendTestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}