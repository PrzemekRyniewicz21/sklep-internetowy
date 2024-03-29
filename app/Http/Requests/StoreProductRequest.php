<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|max:50',
            'description' => 'required|max:1500',
            'amount' => 'required|integer|min:0',
            'price' => 'required|numeric',
            'img' => 'nullable|image',
            'category_id' => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
        ];
    }
}
