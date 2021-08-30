<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
//        $parentCategories = Category::where(['parent_id' => 0, 'status' => 1])->get();
        $newProducts = Product::where('status', 1)->limit(4)->orderBy('id','DESC')->get();
        $saleProducts = Product::where('sale_price','>',0)->where('status', 1)->limit(4)->orderBy('id','DESC')->get();
        return view('public.index', compact('newProducts', 'saleProducts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
//        $parentCategories = Category::where(['parent_id' => 0, 'status' => 1])->get();
        $products = Product::where(['category_id' => $category->id,'status' => 1])->orderBy('id','DESC')->get();
        return view('public.category', compact('category', 'products'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
//        $parentCategories = Category::where(['parent_id' => 0, 'status' => 1])->get();
        $products = Product::where(['category_id' => $product->category_id, 'status' => 1])->inRandomOrder()->limit(4)->get();
        return view('public.product', compact('product','products'));
    }
}
