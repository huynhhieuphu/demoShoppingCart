<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'status'];

    protected $hidden = ['updated_at'];

    public $timestamps = false;

    public function child()
    {
        return $this->hasMany(self::Class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::Class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }

    public function scopeSearch($query)
    {
        if (request()->has('keywords')) {
            $query->where('name', 'LIKE', '%' . request()->keywords . '%');
        }
        return $query;
    }

}
