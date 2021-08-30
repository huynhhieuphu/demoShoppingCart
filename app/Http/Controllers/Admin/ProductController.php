<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    const LIMIT_ROWS = 4;
    public function index(Request $request)
    {
        $data['title'] = 'Product';
        $data['products'] = Product::paginate(self::LIMIT_ROWS);
        $data['msg'] = $request->session()->get('msg') ?? '';
        return view('admin.product.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'Create Product';
        $data['categories'] = Category::where('status', 1)->get();
        $data['msg'] = $request->session()->get('msg') ?? '';
        return view('admin.product.create', $data);
    }

    public function store(StoreProduct $request)
    {
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('asset/uploads/images/'), $fileName);
                $images[] = $fileName;
            }
        }

        $product = new Product();
        $product->name = ucwords($request->name);
        $product->slug = Str::slug($request->name);
        $product->images = json_encode($images);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->sale_price = is_numeric($request->sale_price) ? $request->sale_price : null;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->created_at = date('Y-m-d H:i:s');
        $product->save();

        if($product){
            $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Insert Success </div>');
            return redirect()->route('admin.product.create');
        }
        $request->session()->flash('msg','<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Insert Failed </div>');
        return back();
    }

    public function show()
    {

    }

    public function edit(Request $request)
    {
        $data['title'] = 'Edit Product';
        $data['product'] = Product::findOrFail($request->product);
        $data['categories'] = Category::where('status', 1)->get();
        $data['msg'] = $request->session()->get('msg');
        return view('admin.product.edit', $data);
    }

    public function update(UpdateProduct $request)
    {
        $id = $request->product;
        $oldImages = $request->oldImages;
        $uploadImages = null;

        $images = [];
        if ($request->hasFile('images')) {
            // delete all old pictures
            $arrOldImages = explode('|', $oldImages);
            foreach ($arrOldImages as $oldImage){
                $pathImages = public_path('asset/uploads/images/'.$oldImage);
                if(File::exists($pathImages)){
                    File::delete($pathImages);
                }
            }

            // upload new pictures
            foreach ($request->file('images') as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('asset/uploads/images/'), $fileName);
                $images[] = $fileName;
            }
            $uploadImages = json_encode($images);
        }else{
            $uploadImages = $oldImages;
        }

        $product = Product::findOrFail($id);
        $product->name = ucwords($request->name);
        $product->slug = Str::slug($request->name);
        $product->images = $uploadImages;
        $product->description = trim($request->description);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->sale_price = is_numeric($request->sale_price) ? $request->sale_price : null;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();

        if($product){
            $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Update Success </div>');
            return redirect()->route('admin.product.edit', ['product' => $id]);
        }
        $request->session()->flash('msg','<div class="alert alert-danger"> <i class="fas fa-exclamation-triangle"></i> Update Failed </div>');
        return back();
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->product);
        // delete all picture by id product
        $images = $product->images;
        $arrImages = explode('|', $images);
        foreach ($arrImages as $image){
            $path = public_path('asset/uploads/images/'. $image);
            if(File::exists($path)){
                File::delete($path);
            }
        }
        // delete record
        $product->delete();
        $request->session()->flash('msg','<div class="alert alert-success"> <i class="fas fa-check-circle"></i> Delete Success </div>');
        return redirect()->route('admin.product.index');
    }
}
