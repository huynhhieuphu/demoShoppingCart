<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBanner extends FormRequest
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
            'name' => 'required|alpha_dash|min:2|max:200|unique:banners,name,' . $request->id,
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
