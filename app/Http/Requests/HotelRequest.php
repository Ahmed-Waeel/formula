<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            'country' => 'required|string|size:2',
            'city' => 'required|numeric',
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
            'name.min' =>  __('validation.min', ['attribute' => __('view.name'), 'min' => 3]),
            'name.max' =>  __('validation.max', ['attribute' => __('view.name'), 'max' => 50]),

            'country.required' => __('validation.required', ['attribute' => __('view.country')]),
            'country.string' => __('validation.valid'),
            'country.size' => __('validation.valid'),

            'city.required' => __('validation.required', ['attribute' => __('view.city')]),
            'city.numeric' => __('validation.valid'),
        ];
    }
}
