<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use  App\Http\Requests\StoreCheckout;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $msgCheckout = $request->session()->get('msgCheckout');
        return view('public.checkout', compact('msgCheckout'));
    }

    public function checkout(StoreCheckout $request, Cart $cart)
    {
        $id = Auth::guard('cus')->id();
        $order = Order::create([
            'customer_id' => $id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if($order){
            foreach ($cart->items as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
            $cart->clear();

            $products = Product::inRandomOrder()->limit(4)->get();
            $msgCheckout = '<div class="alert alert-success"> <i class="bi bi-check-circle-fill"></i> Thanh toán thành công</div>';
            return view('public.checkout-success',compact('products', 'msgCheckout'));
        }
        $request->session()->flash('msgCheckout',
            '<div class="alert alert-danger"> <i class="bi bi-exclamation-triangle-fill"></i> Thanh toán bị lỗi </div>');
        return back();
    }
}
