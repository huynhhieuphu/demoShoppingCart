<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBanner;
use App\Http\Requests\UpdateBanner;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    const ROW_LIMIT = 5;

    public function index()
    {
        $title = 'List Banner';
        $banners = DB::table('banners')->paginate(self::ROW_LIMIT);
        return view('admin.banner.index', compact('title', 'banners'));
    }

    public function create(Request $request)
    {
        $title = 'Create Banner';
        $msg = $request->session()->get('msg');
        return view('admin.banner.create', compact('title', 'msg'));
    }

    public function store(StoreBanner $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            $file->move(public_path('asset/uploads/banners/'), $fileName);
        }

        DB::table('banners')->update(['status' => 0]);
        $banner = DB::table('banners')->insert([
            'name' => $request->name,
            'link' => $request->link,
            'images' => $fileName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($banner) {
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Insert Success </div>');
            return redirect()->route('admin.banner.create');
        }
        $request->session()->flash('msg',
            '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Insert Failed </div>');
        return back()->withInput();
    }

    public function edit(Request $request)
    {
        $title = 'Edit Banner';
        $msg = $request->session()->get('msg');
        $banner = DB::table('banners')
            ->where('id', $request->id)
            ->first();

        if ($banner) {
            return view('admin.banner.edit', compact('title', 'banner', 'msg'));
        }
        return abort(404);
    }

    public function update(UpdateBanner $request)
    {
//        dd($request->all());
        $fileName = $request->image_old;
        if ($request->hasFile('image')) {
            //delete image old
            $imageOld = public_path('asset/uploads/banners/' . $fileName);
            if (file_exists($imageOld)) {
                unlink($imageOld);
            }

            //upload image new
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            $file->move(public_path('asset/uploads/banners/'), $fileName);
        }

        $banner = DB::table('banners')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'link' => $request->link,
                'images' => $fileName,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        if ($banner) {
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Update Success </div>');
            return redirect()->route('admin.banner.edit', ['id' => $request->id]);
        }
        $request->session()->flash('msg',
            '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Update Failed </div>');
        return back()->withInput();
    }

    public function delete(Request $request)
    {
        DB::table('banners')->update(['status' => 0]);

        $banner = DB::table('banners')
            ->where('id', $request->id)
            ->update(['status' => 1]);

        if ($banner) {
            return redirect()->route('admin.banner.index')->with('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Active Success </div>');
        }

        return abort(404);
    }
}
