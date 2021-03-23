<?php

namespace Ocart\Media\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaFolderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required'
        ];
    }
}