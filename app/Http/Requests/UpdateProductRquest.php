<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateProductRquest extends FormRequest
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
        Log::channel('debug')->info("????");
        return [
            'name' => 'required|max:50',
            // 'short_description' => 'required|max:1500',
            // 'amount' => 'required|integer|min:0',
            // 'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
        ];
    }
}
