<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.brands.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.brands.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:155|unique:brands,name',
            'brand_logo' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '-' . $request->brand_name . '.' . $request->brand_logo->extension();

        $request->brand_logo->move(public_path('images/brand_images'), $newImageName);

        $brand = new Brands();
        $brand->name = $request->brand_name;
        $brand->logo = $newImageName;
        $brand->category_id = $request->categoryID;
        $brand->save();
        return redirect('/admin/brands');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brands::where('id', '=', $id)->first();
        $category = Category::all();
        return view('admin.brands.edit', compact('brand','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|max:155',
            'brand_logo' => 'mimes:jpg,png,jpeg|max:5048'
        ]);
        $brand = Brands::where('id','=',$id)->first();
        if ($request->hasFile('brand_logo')){
            $imageName = public_path('images\brand_images\\') . $brand->logo;
            if(File::exists($imageName)){
                File::delete($imageName);
            }
            $file = $request->file('brand_logo');
            $filename = time() . '-' . $request->brand_name . '.' . $request->brand_logo->extension();
            $file->move(public_path('images\brand_images'),$filename);
            $brand->logo = $filename;
        }
        $brand->name = $request->brand_name;
        $brand->category_id = $request->categoryID;
        $brand->save();
        return redirect('/admin/brands');
    }

    //Load delete modal
    public function delete($id){
        $brand = Brands::find($id);
        return view('admin.brands.delete',compact('brand'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $brand = Brands::where('id','=',$id)->first();
        $brand->delete();
        return redirect('/admin/brands');
    }

    public function viewBrands($name,$id){
        $brands = Brands::where('category_id','=',$id)->get();
        $category_name = $name;
        return view('ecommerce.brands',compact('brands','category_name'));
    }

}
