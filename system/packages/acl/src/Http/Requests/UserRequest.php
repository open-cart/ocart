<?php
namespace Ocart\Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Ocart\Core\Enums\BaseStatusEnum;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'    => 'required|max:120',
        ];

        $passwords = [
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ];

        if ($this->id) {
            $passwords = [
                'password' => 'filled|min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ];
        }
        if (!$this->password) {
            $passwords = [];
        }

        if (!$this->id) {
            $rules['email'] = [
                'required',
                Rule::unique('users', 'email')
            ];
        }

        return $rules + $passwords;
    }
}
