<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'image' => 'nullable|image|max:5120',
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

            'image.image' => __('validation.image', ['attribute' => __('view.image')]),
            'image.max' => __('validation.max.file', ['attribute' => __('view.image'), 'max' => 5]),
        ];
    }
}
