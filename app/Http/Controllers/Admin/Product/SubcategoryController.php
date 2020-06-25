<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        $subcategory = Subcategory::paginate(10);
        $category    = Category::all();
        return view('admin.pages.sub-category.sub-category', compact('subcategory', 'category'));
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
            'subcategory_name' => 'required|unique:subcategories|max:55',
            'category_id' => 'required',
        ]);

        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $notification=array(
            'messege'=>'Sub-Category successfully added',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.subcategory')->with($notification);
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $category    = Category::all();
        return view('admin.pages.sub-category.edit-subcategory', compact('subcategory', 'category'));
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
            'subcategory_name' => 'required|max:55',
            'category_id' => 'required',
        ]);

        $subcategory = Subcategory::find($id);
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $notification=array(
            'messege'=>'Sub-Category successfully updated',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.subcategory')->with($notification);
    }

    /**
     * Delete existing category.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->forceDelete();
        $notification=array(
            'messege'=>'Sub-category successfully deleted',
            'alert-type'=>'error'
        );
        return redirect()->route('admin.subcategory')->with($notification);
    }
}
