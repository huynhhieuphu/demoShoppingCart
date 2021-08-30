<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->limit(4)->get();
        return view('public.cart', compact('products'));
    }

    public function add(Cart $cart, $id)
    {
        $product = Product::find($id);
        $quantity = is_numeric(request()->quantity) && request()->quantity < 10 ? request()->quantity : 1;
        $cart->add($product, $quantity);
        return redirect()->back();
    }

    public function update(Cart $cart, $id)
    {
        $quantity = is_numeric(request()->quantity) && request()->quantity < 10 ? request()->quantity : 1;
        $cart->update($id, $quantity);
        return redirect()->back();
    }

    public function remove(Cart $cart, $id)
    {
        $cart->remove($id);
        return redirect()->back();
    }

    public function clear(Cart $cart)
    {
        $cart->clear();
        return redirect()->back();
    }
}
