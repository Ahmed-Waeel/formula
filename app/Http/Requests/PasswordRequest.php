<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'current_password:web'],
            'password' => ['required', 'min:8', 'regex:/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/', 'confirmed']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'old_password.required' => __('validation.required', ['attribute' => __('view.oldPassword')]),
            'old_password.current_password' => __('validation.wrongPassword'),

            'password.required' => __('validation.required', ['attribute' => __('view.password')]),
            'password.min' => __('validation.min', ['attribute' => __('view.password'), 'min' => 8]),
            'password.regex' => __('validation.passwordValidation'),
            'password.confirmed' => __('validation.passwordConfirmation'),
        ];
    }
}
