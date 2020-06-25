<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Admin\Posttag;
use Illuminate\Http\Request;

class PostTagController extends Controller
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
        $tags = Posttag::paginate(8);
        return view('admin.pages.post-tag.post-tag', compact('tags'));
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
            'tag_name_en' => 'required|unique:posttags|max:55',
        ]);

        $brand = new Posttag();
        $brand->tag_name_en = $request->tag_name_en;
        $brand->tag_name_bn = $request->tag_name_bn;
        $brand_logo = $request->file('brand_logo');
            $brand->save();
            $notification=array(
                'messege'=>'Tags successfully added.',
                'alert-type'=>'success'
            );
            return redirect()->route('admin.post.tag')->with($notification);
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $brand = Posttag::findOrFail($id);
        return view('admin.pages.post-tag.edit-post-tag', compact('brand'));
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
            'tag_name_en' => 'required|max:55',
        ]);
        $brand = Posttag::find($id);
        $brand->tag_name_en = $request->tag_name_en;
        $brand->tag_name_bn = $request->tag_name_bn;
            $brand->save();
            $notification=array(
                'messege'=>'Tags successfully updated',
                'alert-type'=>'success'
            );
            return redirect()->route('admin.post.tag')->with($notification);
    }

    /**
     * Delete existing category.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $brand = Posttag::find($id);
        $brand->forceDelete();
        $notification=array(
            'messege'=>'Tags successfully deleted.',
            'alert-type'=>'error'
        );
        return redirect()->route('admin.post.tag')->with($notification);
    }
}
