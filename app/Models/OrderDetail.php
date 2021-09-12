<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    public $fillable = ['order_id', 'product_id', 'quantity', 'price', 'status', 'created_at'];
    public $timestamps = false;

    public function orders()
    {
        return $this->belongsTo('App\Models\Order','order_id', 'id');
    }
}
