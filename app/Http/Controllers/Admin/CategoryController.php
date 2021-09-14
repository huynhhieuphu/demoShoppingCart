<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use Illuminate\Support\Facades\Route;
use App\Helper\Helper;

class CategoryController extends Controller
{
    const LIMIT_ROWS = 3;

    public function index(Request $request)
    {
        $title = 'Category';
        $categories = Category::search()->paginate(self::LIMIT_ROWS);
//        if($request->has('keywords')){
//            $categories = Category::where('name', 'LIKE', '%'. $request->keywords . '%')->paginate(self::LIMIT_ROWS);
//        }
        $msg = $request->session()->get('msg');
        return view('admin.category.index', compact('title', 'categories', 'msg'));
    }

    public function create(Request $request)
    {
        $data['title'] = 'Create Category';
        $data['parents'] = Category::where('status', 1)->get();
        $data['msg'] = $request->session()->get('msg');
        return view('admin.category.create', $data);
    }

    public function store(StoreCategory $request)
    {
        $category = new Category();
        $category->name = ucfirst($request->name);
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->created_at = date('Y-m-d H:i:s');
        $category->save();

        if ($category) {
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Insert Success </div>');
        } else {
            $request->session()->flash('msg',
                '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Insert Failed </div>');
        }
        return redirect()->route('admin.category.create');
    }

    public function show()
    {

    }

    public function edit(Request $request)
    {
        $data['title'] = 'Edit Category';
        $data['category'] = Category::findOrFail($request->category);
        $data['parents'] = Category::where('status', 1)->get();
        $data['msg'] = $request->session()->get('msg');
        return view('admin.category.edit', $data);
    }

    public function update(UpdateCategory $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->name = ucfirst($request->name);
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        if ($category) {
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Update Success </div>');
            return redirect()->route('admin.category.edit', ['category' => $id]);
        }
        $request->session()->flash('msg',
            '<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Update Failed </div>');
        return back();
    }

    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->category);
//        dd($category->products->count());
        if ($category->child->count() === 0 && $category->products->count() === 0) {
            $category->delete();
            $request->session()->flash('msg',
                '<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Delete Success </div>');
            return redirect()->route('admin.category.index');
        }
        $request->session()->flash('msg',
            '<div class="alert alert-warning"> <i class="fas fa-exclamation-triangle"></i> Can\'t Delete </div>');
        return back();
    }
}
