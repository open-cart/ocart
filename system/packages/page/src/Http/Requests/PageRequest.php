<?php
namespace Ocart\Page\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use System\Core\Enums\BaseStatusEnum;

class PageRequest extends FormRequest
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
//            'slug'    => 'required|max:255',
            'status'  => Rule::in(BaseStatusEnum::values()),
            'is_featured' => Rule::in(['1', '2'])
        ];
    }
}
