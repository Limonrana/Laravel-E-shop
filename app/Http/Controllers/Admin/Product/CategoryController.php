<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = Category::paginate(10);
        return view('admin.pages.category.category', compact('category'));
    }

    /**
     * Store a new category.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
            'category_icon' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_icon = $request->category_icon;
        $category->save();
        $notification=array(
            'messege'=>'Category successfully added.',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.category')->with($notification);
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.category.edit-category', compact('category'));
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:55',
            'category_icon' => 'required',
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->category_icon = $request->category_icon;
        $category->save();
        $notification=array(
            'messege'=>'Category successfully updated.',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.category')->with($notification);
    }

    /**
     * Delete existing category.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $category = Category::find($id);
        $subcategory = Subcategory::where('category_id', $id)->count();
        if($subcategory > 0){
            $notification=array(
                'messege'=>'Please Delete Subcategory At First',
                'alert-type'=>'error'
            );
            return redirect()->route('admin.subcategory')->with($notification);
        } else {
            $category->forceDelete();
            $notification=array(
                'messege'=>'Category successfully deleted.',
                'alert-type'=>'error'
            );
            return redirect()->route('admin.category')->with($notification);
        }
    }
}
