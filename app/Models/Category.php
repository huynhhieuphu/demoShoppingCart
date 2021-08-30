<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = false;

    public function child()
    {
        return $this->hasMany('App\Models\Category', 'parent_id','id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
