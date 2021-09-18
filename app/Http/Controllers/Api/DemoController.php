<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;

class DemoController extends Controller
{
    public function index()
    {
//        $data = Category::all();
        // cach su dung resources
        $data = CategoryResource::collection(Category::all());
        return response()->json([
            'data' => $data,
            'code' => 200,
            'messages' => 'Danh sach danh muc'
        ]);
    }

    public function loadView()
    {
        $categories = Category::all();
        return view('public.api-view',compact('categories'));
    }

    public function show(Request $request)
    {
        $data = Category::find($request->id);
        if($data){
            return response()->json([
                'data' => $data,
                'code' => 200,
                'messages' => 'chi tiet danh muc'
            ]);
        }
        return response()->json([
            'data' => null,
            'code' => 404,
            'messages' => 'khong co du lieu'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100|unique:categories,name',
            'status' => 'required|in:1,0',
        ]);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'error' => $validator->errors()->all()
            ]);
        }

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $category = Category::create($request->all());

        if ($category) {
            return response()->json([
                'data' => $category,
                'code' => 200,
                'messages' => 'them moi danh muc thanh cong'
            ]);
        }
        return response()->json([
            'data' => $category,
            'code' => 404,
            'messages' => 'them moi danh muc that bai'
        ]);
    }

    public function update(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100|unique:categories,name,' . $request->id,
            'status' => 'required|in:1,0',
        ]);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'error' => $validator->errors()->all()
            ]);
        }

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $category = Category::find($request->id)->update($request->all());

        if ($category) {
            return response()->json([
                'data' => Category::find($request->id),
                'code' => 200,
                'messages' => 'cap nhat danh muc thanh cong'
            ]);
        }
        return response()->json([
            'data' => $category,
            'code' => 404,
            'messages' => 'cap nhat danh muc that bai'
        ]);
    }

    public function destroy(Request $request)
    {
        $category = Category::find($request->id);

        if($category->child->count() === 0 && $category->products->count() === 0){
            $category->delete();
            return response()->json([
                'data' => null,
                'code' => 200,
                'messages' => 'xoa danh muc thanh cong'
            ]);
        }
        return response()->json([
            'data' => null,
            'code' => 404,
            'messages' => 'that bai xoa danh muc'
        ]);
    }
}
