<?php


namespace Ocart\Blog\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|max:120',
            'content' => 'required',
        ];
    }
}
