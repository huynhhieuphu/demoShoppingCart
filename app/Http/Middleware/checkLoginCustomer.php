<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkLoginCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    private $cus;

    public function __construct()
    {
        // ??? chưa hiểu muốn làm gì ở đây
    }

    public function handle($request, Closure $next, $guard = 'cus')
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }
        return redirect()->route('admin.customer.login.form')->with('msg',
            '<div class="alert alert-danger"> <i class="bi bi-exclamation-triangle-fill"></i> Vui lòng đăng nhập </div>');
    }
}
