<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBanner extends FormRequest
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
            'name' => 'required|alpha_dash|min:2|max:200|unique:banners,name',
            'link' => 'nullable|url',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
