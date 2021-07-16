<?php
namespace Ocart\EcommerceReview\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'star'    => 'required|max:5',
            'comment' => 'required',
            'product_id' => 'required',
            'status' => 'required',
        ];
    }
}
