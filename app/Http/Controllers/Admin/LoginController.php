<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Login;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $msgLogin = $request->session()->get('msgLogin') ?? '';
        return view('admin.login.index', compact('msgLogin'));
    }

    public function handleLogin(Login $request)
    {
//        $credentials = $request->only('username','password');
        $credentials = ['username' => $request->username, 'password' => $request->password, 'status' => 1];
        if (Auth::attempt($credentials, $request->has('remember'))) {
            User::where('id', Auth::id())
                ->update([
                    'last_login' => date('Y-m-d H:i:s')
                ]);
            return redirect()->route('admin.site.index');
        }
        $request->session()->flash('msgLogin',
            '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> The user name or password is incorrect </div>');
        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
