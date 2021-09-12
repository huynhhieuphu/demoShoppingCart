<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        $total_money = DB::table('order_details')
            ->whereMonth('created_at', date('m'))
            ->sum('price');

        $total_sell = DB::table('order_details')
            ->whereMonth('created_at', date('m'))
            ->sum('quantity');

        $count_products = Product::where('status', 1)->count();
        $count_orders = Order::count();

        // lấy danh sách order mới nhất
        $new_orders = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('orders.id',
                DB::raw('SUM(order_details.quantity) as total_quantity, SUM(order_details.price) as total_price'),
                'orders.created_at')
            ->groupBy('orders.id', 'orders.created_at')
            ->orderBy('orders.created_at', 'DESC')
            ->limit(5)
            ->get();

        return view('admin.site.index',
            compact('total_money', 'total_sell', 'count_orders', 'count_products', 'new_orders'));
    }
}
