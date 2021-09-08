<?php
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable{
    use Notifiable;

    protected $table = "customers";

    protected $fillable = [
        'username', 'password', 'email', 'first_name', 'last_name',
        'address', 'phone', 'status', 'last_login', 'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

}
