<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
    const LIMIT_ROWS = 5;
    public function index()
    {
        $data['title'] = 'User';
        $data['users'] = User::paginate(self::LIMIT_ROWS);
//        $data['msg'] = $request->session()->get('msg');
        return view('admin.user.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'Create User';
        $data['msg'] = $request->session()->get('msg');
        return view('admin.user.create', $data);
    }

    public function store(StoreUser $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        if($user){
            $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Insert Success </div>');
            return redirect()->route('admin.user.create');
        }
        $request->session()->flash('msg','<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Insert Failed </div>');
        return redirect()->back();
    }

    public function show()
    {

    }

    public function edit(Request $request)
    {
        $data['title'] = 'Edit User';
        $data['user'] = User::findOrFail($request->user);
        $data['msg'] = $request->session()->get('msg');
        return view('admin.user.edit', $data);
    }

    public function update(UpdateUser $request)
    {

        $id = $request->user;
        $user = User::findOrFail($id);
        if(!empty($request->password) && !empty($request->password_confirmation)){
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->status = $request->status;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        if($user){
            $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Update Success </div>');
            return redirect()->route('admin.user.edit', ['user' => $id]);
        }
        $request->session()->flash('msg','<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Update Failed </div>');
        return back();
    }

    public function destroy()
    {

    }
}
