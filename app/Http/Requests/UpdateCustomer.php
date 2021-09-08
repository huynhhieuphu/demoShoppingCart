<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomer extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
            'email' => 'required|email|min:6|max:200|unique:customers,email,'.$request->customer,
            'first_name' => 'required|string|min:2|max:120',
            'last_name' => 'required|string|min:2|max:120',
            'address' => 'required|string|min:6|max:100',
            'phone' => ['required', 'regex:/^(\+84|84|0)\d{9}$/'],
            'status' => 'required|in:0,1'
        ];
    }
}
