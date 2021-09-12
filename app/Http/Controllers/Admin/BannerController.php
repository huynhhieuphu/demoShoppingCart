<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.index');
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store()
    {

    }

    public function edit()
    {
        return view('admin.banner.edit');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
