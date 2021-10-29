<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.categories.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
           'category_name' => 'required|max:155|unique:categories,name',
            'category_image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '-' . $request->category_name . '.' . $request->category_image->extension();

        $request->category_image->move(public_path('images/category_images'),$newImageName);

        $category = new Category();
        $category->name = $request->category_name;
        $category->image = $newImageName;
        $category->save();
        return redirect('/admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id','=',$id)->first();
        return view('admin.categories.edit',compact('category'));
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
            'category_name' => 'required|max:155|unique:categories,name',
            'category_image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        $category = Category::where('id','=',$id)->first();
        $imageName = public_path('images/category_images') . $request->category_image;
        if (File::exists($imageName)){
            File::delete($imageName);
        }
        $file = $request->file('category_image');
        $filename = time() . '-' . $request->category_name . '.' . $request->category_image->extension();
        $file->move(public_path('images/category_images'),$filename);
        $category->image = $filename;
        $category->name = $request->category_name;
        $category->update();
        return redirect('/admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $category = Category::where('id','=',$id)->first();
        $category->delete();
        return redirect('/admin/category');
    }
}
