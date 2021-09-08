<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
            'username' => 'required|alpha_dash|min:4|max:255|unique:customers,username',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'email' => 'required|email|min:6|max:200|unique:customers,email',
            'first_name' => 'required|string|min:2|max:120',
            'last_name' => 'required|string|min:2|max:120',
            'address' => 'required|string|min:6|max:100',
            'phone' => ['required', 'regex:/^(\+84|84|0)\d{9}$/'],
            'status' => 'required|in:0,1'
        ];
    }
}
