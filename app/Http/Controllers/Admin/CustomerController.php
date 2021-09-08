<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomer;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomer;
use Illuminate\Support\Facades\Hash;

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
        return view('admin.customer.create', compact('title','msg'));
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

        if($customer){
            $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Insert Success </div>');
            return redirect()->route('admin.customer.create');
        }
        $request->session()->flash('msg','<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Insert Failed </div>');
        return back()->withInput();
    }

    public function edit(Request $request)
    {
        $title = 'Edit Customer';
        $customer = Customer::findOrFail($request->customer);
        $msg = $request->session()->get('msg');
        return view('admin.customer.edit', compact('title','customer', 'msg'));
    }

    public function update(UpdateCustomer $request)
    {
//        dd($request->all());
        $id = $request->customer;
        $customer = Customer::findOrFail($id);
        if(!empty($request->password) && !empty($request->password_confirmation)){
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

        if($customer){
            $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Update Success </div>');
            return redirect()->route('admin.customer.edit', ['customer' => $id]);
        }
        $request->session()->flash('msg','<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Update Failed </div>');
        return back()->withInput();
    }

    public function destroy(Request $request)
    {
//        $customer = Customer::findOrFail($request->customer);
//        $customer->status = 0;
//        $customer->save();

        Customer::where('id', $request->customer)->update(['status' => 0]);
        return redirect()->route('admin.customer.index')
            ->with('msg', '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Delete Success </div>');
    }
}
