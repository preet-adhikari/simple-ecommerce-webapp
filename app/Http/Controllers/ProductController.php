<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.view');
    }

    public function create()
    {
        $brands = Brands::all();
        return view('admin.products.create',compact('brands'));
    }

    public function store(Request $request){
        $request->validate([
           'product_name' => 'required|max:155|unique:products,name',
           'product_stock' => 'required|numeric|min:0|not_in:0',
            'product_price' => 'required|numeric|min:0|not_in:0',
            'product_image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '-' . $request->product_name . '.' . $request->product_image->extension();

        $request->product_image->move(public_path('images/product_images'),$newImageName);

        $product = new Product();
        $product->name = $request->product_name;
        $product->brand_id = $request->brandID;
        $product->stock = $request->product_stock;
        $product->price = $request->product_price;
        $product->image = $newImageName;
        $product->save();
        return redirect('/admin/product');

    }

    public function edit($id){
        $product = Product::find($id);
        $brands = Brands::all();
        return view('admin.products.edit',compact('product','brands'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_name' => 'required|max:155',
            'product_stock' => 'required|numeric|min:0|not_in:0',
            'product_price' => 'required|numeric|min:0|not_in:0',
            'product_image' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        $product = Product::where('id','=',$id)->first();
        if ($request->hasFile('product_image')){
            $imageName = public_path('images\product_images\\') . $product->image;
            if(File::exists($imageName)){
                File::delete($imageName);
            }
            $file = $request->file('product_image');
            $filename = time() . '-' . $request->product_name . '.' . $request->product_image->extension();
            $file->move(public_path('images\product_images'),$filename);
            $product->image = $filename;
        }
        $product->name = $request->product_name;
        $product->stock = $request->product_stock;
        $product->price = $request->product_price;
        $product->brand_id = $request->brandID;
        $product->save();
        return redirect('/admin/product');
    }

    public function destroy($id){
        $product = Product::where('id','=',$id)->first();
        $product->delete();
        return redirect('/admin/product');
    }

    //View products
    public function viewProduct($name,$id){
        $products = Product::where('brand_id','=',$id)->get();
        $brand_name = $name;
        return view('ecommerce.products',compact('products','brand_name'));

    }
}
