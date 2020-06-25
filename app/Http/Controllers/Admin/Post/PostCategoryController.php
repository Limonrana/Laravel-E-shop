<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Admin\Postcategory;
use App\Models\Admin\Postsubcategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
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
        $category = Postcategory::paginate(10);
        return view('admin.pages.post-category.post-category', compact('category'));
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
            'category_name_en' => 'required|unique:postcategories|max:55',
        ],
        [
            'category_name_en' => 'The category name field is required (English)',
        ]
        );

        $category = new Postcategory();
        $category->category_name_en = $request->category_name_en;
        $category->category_name_bn = $request->category_name_bn;
        $category->save();
        $notification=array(
            'messege'=>'Category successfully added.',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.post.category')->with($notification);
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $category = Postcategory::findOrFail($id);
        return view('admin.pages.post-category.edit-post-category', compact('category'));
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
            'category_name_en' => 'required|max:55',
        ],
            [
                'category_name_en' => 'The category name field is required (English)',
            ]
        );

        $category = Postcategory::find($id);
        $category->category_name_en = $request->category_name_en;
        $category->category_name_bn = $request->category_name_bn;
        $category->save();
        $notification=array(
            'messege'=>'Category successfully updated.',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.post.category')->with($notification);
    }

    /**
     * Delete existing category.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $category = Postcategory::find($id);
        $subcategory = Postsubcategory::where('category_id', $id)->count();
        if($subcategory > 0){
            $notification=array(
                'messege'=>'Please Delete Subcategory At First',
                'alert-type'=>'error'
            );
            return redirect()->route('admin.post.subcategory')->with($notification);
        } else {
            $category->forceDelete();
            $notification=array(
                'messege'=>'Category successfully deleted.',
                'alert-type'=>'error'
            );
            return redirect()->route('admin.post.category')->with($notification);
        }
    }
}
