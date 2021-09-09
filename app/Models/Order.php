<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $fillable = ['customer_id', 'full_name', 'address', 'phone', 'note', 'created_at'];
    public $timestamps = false;
}
