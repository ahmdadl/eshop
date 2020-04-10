<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            'name' => 'required|string',
            'brand' => 'required|string',
            'info' => 'required|string|min:10',
            'price' => 'required|numeric|min:1',
            'amount' => 'required|numeric|min:1',
            'save' => 'required|numeric|min:0|max:100',
            'color' => 'required|string',
            'is_new' => 'sometimes'
        ];
    }
}
