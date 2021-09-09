<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckout extends FormRequest
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
            'full_name' => 'required|string|min:2|max:255',
            'address' => 'required|string|min:6|max:200',
            'phone' => ['required', 'regex:/^(\+84|84|0)\d{9}$/'],
            'note' => 'nullable|string|min2'
        ];
    }
}
