<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'phone' => 'nullable|regex:/[+)0-9(  -]*/|min:5|max:20',
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

            'phone.regex' => __('validation.regex', ['attribute' => __('view.phone')]),
            'phone.min' => __('validation.min.numeric', ['attribute' => __('view.phone'), 'min' => 5]),
            'phone.max' =>  __('validation.max.numeric', ['attribute' => __('view.phone'), 'max' => 20]),
        ];
    }
}
