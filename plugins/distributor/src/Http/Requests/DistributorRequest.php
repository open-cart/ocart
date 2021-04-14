<?php


namespace Ocart\Distributor\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class DistributorRequest extends FormRequest
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
        ];
    }
}
