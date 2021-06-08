<?php

namespace Ocart\Attribute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeGroupCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:120',
        ];
    }
}