<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
        $categories = Category::select('id')->get()->toArray();
        $strCate = '';
        foreach ($categories as $category){
            $strCate .= empty($strCate) ? $category['id'] : ',' . $category['id'];
        }
        return [
            'name' => 'required|string|min:6|max:200|unique:products,name',
            'images' => 'required|max:4',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // 2048 kb = 2 mb
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'quantity' => 'required|numeric|min:0|max:100',
            'category_id' => 'required|in:' . $strCate,
            'description' => 'nullable|string|min:2',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'images.max' => 'Limit 4 file uploads',
            'images.*.mimes' => 'Only JPG, JPEG, PNG are allowed.',
            'category_id.required' => 'Please choose a category',
        ];
    }
}
