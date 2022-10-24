<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUpdateRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'role' => 'required|numeric',
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
            'name.required' => __('validation.required', ['attribute' => __('view.name')]),
            'name.string' =>  __('validation.string', ['attribute' => __('view.name')]),
            'name.min' => __('validation.min', ['attribute' => __('view.name'), 'min' => 3]),
            'name.max' =>  __('validation.max', ['attribute' => __('view.name'), 'max' => 50]),

            'email.required' => __('validation.required', ['attribute' => __('view.email')]),
            'email.email' => __('validation.email', ['attribute' => __('view.email')]),

            'role.required' => __('validation.required', ['attribute' => __('view.role')]),
            'role.numeric' => __('validation.roleValidation'),
        ];
    }
}
