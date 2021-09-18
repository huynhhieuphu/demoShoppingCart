<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomer;
use App\Http\Requests\UpdateCustomer;
use App\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginCustomer;

class CustomerController extends Controller
{
    public function index()
    {
        $title = 'Customers';
        $customers = Customer::all();
        return view('admin.customer.index', compact('title', 'customers'));
    }

    public function create(Request $request)
    {
        $title = 'Create Customer';
        $msg = $request->session()->get('msg');
        return view('admin.customer.create', compact('title', 'msg'));
    }

    public function store(StoreCustomer $request)
    {
        $customer = new Customer();
        $customer->username = $request->username;
        $customer->password = Hash::make($request->passwword);
        $customer->email = $request->email;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->created_at = date('Y-m-d H:i:s');
        $customer->save();

        if ($customer) {
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Insert Success </div>');
            return redirect()->route('admin.customer.create');
        }
        $request->session()->flash('msg',
            '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Insert Failed </div>');
        return back()->withInput();
    }

    public function edit(Request $request)
    {
        $title = 'Edit Customer';
        $customer = Customer::findOrFail($request->customer);
        $msg = $request->session()->get('msg');
        return view('admin.customer.edit', compact('title', 'customer', 'msg'));
    }

    public function update(UpdateCustomer $request)
    {
//        dd($request->all());
        $id = $request->customer;
        $customer = Customer::findOrFail($id);
        if (!empty($request->password) && !empty($request->password_confirmation)) {
            $customer->password = Hash::make($request->password);
        }
        $customer->email = $request->email;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->updated_at = date('Y-m-d H:i:s');
        $customer->save();

        if ($customer) {
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Update Success </div>');
            return redirect()->route('admin.customer.edit', ['customer' => $id]);
        }
        $request->session()->flash('msg',
            '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Update Failed </div>');
        return back()->withInput();
    }

    public function destroy(Request $request)
    {
        Customer::find($request->customer)->delete();
        return redirect()->route('admin.customer.index')
            ->with('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Delete Success </div>');
    }

    public function showLoginForm(Request $request)
    {
        $msgLogin = $request->session()->get('msgLogin');
        return view('public.login', compact('msgLogin'));
    }

    public function login(LoginCustomer $request)
    {
        if (Auth::guard('cus')->attempt([
            'username' => $request->username,
            'password' => $request->password,
            'status' => 1
        ], $request->has('remember'))) {
            Customer::where('id', Auth::guard('cus')->id())
                ->update([
                    'last_login' => date('Y-m-d H:i:s')
                ]);
            return redirect()->route('home.index');
        }

        $request->session()->flash('msgLogin',
            '<div class="alert alert-danger"> <i class="bi bi-exclamation-triangle-fill"></i> The user name or password is incorrect </div>');
        return back();
    }

    public function logout()
    {
        Auth::guard('cus')->logout();
        return redirect()->route('home.index');
    }

    public function showRegistrationForm(Request $request)
    {
        $msgRegister = $request->session()->get('msgRegister');
        return view('public.register', compact('msgRegister'));
    }

    public function register(RegisterCustomer $request)
    {
        //dd($request->request);
        $customer = Customer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($customer) {
            $products = Product::inRandomOrder()->limit(4)->get();
            $msgRegister = '<div class="alert alert-success"> <i class="bi bi-check-circle-fill"></i> Chúc mừng bạn đã đăng ký thành công.</div>';
            return view('public.register-success', compact('products','msgRegister'));
        }
        $request->session()->flash('msgRegister',
            '<div class="alert alert-danger"> <i class="bi bi-exclamation-triangle-fill"></i> Đăng ký thất bại </div>');
        return back()->withInput();
    }

    public function showTrash()
    {
        $title = 'Trash Customer';
        $customers = Customer::onlyTrashed()->get();
        return view('admin.customer.trash', compact('title','customers'));
    }

    public function putBack($id)
    {
        $customer = Customer::withTrashed()->find($id);

        if($customer){
            $customer->restore();
            return response()->json([
                'code' => 200,
                'message' => 'phuc hoi khach hang thanh cong',
                'url' => route('admin.customer.show.trash')
            ]);
        }
        return response()->json([
            'code' => 404,
            'message' => 'phuc hoi khach hang that bai'
        ]);
    }

    public function deleteImmediately(Request $request, $id)
    {
        $customer = Customer::withTrashed()->find($id);
        if($customer){
            $customer->forceDelete();
            return response()->json([
                'code' => 200,
                'message' => 'xoa khach hang thanh cong',
                'url' => route('admin.customer.show.trash')
            ]);
        }
        return response()->json([
            'code' => 404,
            'message' => 'xoa khach hang that bai'
        ]);
    }
}
