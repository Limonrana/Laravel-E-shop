<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use App\Models\Admin\Postcategory;
use App\Models\Admin\Postsubcategory;
use App\Models\Admin\Posttag;
use App\Models\Admin\Subcategory;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
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
     * Show the application post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_post = Post::paginate(10);
        $category = Postcategory::all();
        $tag = Posttag::all();
        return view('admin.pages.post.all-posts', compact('all_post', 'category', 'tag'));
    }

    /**
     * Show the post subcategory via ajax.
     *
     * @return //subcategory data
     */
    public function ajaxSubcategory($category_id)
    {
        $subcategory = Postsubcategory::where('category_id', $category_id)->get();
        return response()->json($subcategory);
    }

    /**
     * Show the application add post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showProductForm()
    {
        $category = Postcategory::all();
        $tag = Posttag::all();
        return view('admin.pages.post.add-new', compact('category', 'tag'));
    }

    /**
     * Store a new post.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_title_en'         => 'required|unique:posts|max:85',
            'slug'                  => 'required',
            'category_id'           => 'required|integer',
            'post_description_en'   => 'required',
            'featured_image'        => 'required',
        ],
            [
                'category_id.integer' => 'The category field is required.',
            ]);

        $post = new Post();
        $post->post_title_en        = $request->post_title_en;
        $post->post_title_bn        = $request->post_title_bn;
        $post->category_id          = $request->category_id;
        $post->slug                 = $request->slug;
        $post->post_description_en  = $request->post_description_en;
        $post->post_description_bn  = $request->post_description_bn;
        $post->video_link           = $request->video_link;
        $featured_image             = $request->file('featured_image');
        $post->status               = 1;

        $tag_name                   = $request->tag_name;

        //Array Data To String Convert with join
        if ($tag_name){
            $tag_id_list            = join(",",$tag_name);
            //Get tags value
            $post->tag_name         = $tag_id_list;
        }

        if ($featured_image) {

            $main_image = Str::random(50).'.'.$featured_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($featured_image)->resize(1280, 500)->save(public_path('uploads/posts/' . $main_image));
            $post->featured_image = 'uploads/posts/' . $main_image;

        }

        $post->save();
        $notification = array(
            'messege' => 'Post successfully added',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.post')->with($notification);
    }

    /**
     * Edit existing Post.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $category = Postcategory::all();
        $tag      = Posttag::all();
        return view('admin.pages.post.edit-post', compact('post', 'category', 'tag'));
    }

    /**
     * Edit existing Post.
     *
     * @param  //id
     * @return //view
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'post_title_en'         => 'required|max:85',
            'slug'                  => 'required',
            'category_id'           => 'required|integer',
            'post_description_en'   => 'required',
        ],
            [
                'category_id.integer' => 'The category field is required.',
            ]);

        $post = Post::find($id);
        $post->post_title_en            = $request->post_title_en;
        $post->post_title_bn            = $request->post_title_bn;
        $post->category_id              = $request->category_id;
        $post->slug                     = $request->slug;
        $post->post_description_en      = $request->post_description_en;
        $post->post_description_bn      = $request->post_description_bn;
        $post->video_link               = $request->video_link;

        $tag_name                       = $request->tag_name;

        //Array Data To String Convert with join
        if ($tag_name){
            $tag_id_list                = join(",",$tag_name);
            //Get tags value
            $post->tag_name             = $tag_id_list;
        }

        //Old Image Link
        $old_featured_image     = $request->old_featured_image;

        //New Image
        $featured_image         = $request->file('featured_image');

        if ($featured_image) {

            unlink($old_featured_image);
            $main_image = Str::random(50) . '.' . $featured_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($featured_image)->resize(1280, 500)->save(public_path('uploads/posts/' . $main_image));
            $post->featured_image = 'uploads/posts/' . $main_image;

        }

        $post->save();
        $notification = array(
            'messege' => 'Post successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.post')->with($notification);
    }

    /**
     * Delete existing Post.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $post = Post::find($id);
        $featured_image = $post->featured_image;
        if ($featured_image) {
            unlink($featured_image);
        }

        $post->forceDelete();
        $notification = array(
            'messege' => 'Post successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.post')->with($notification);
    }

    /**
     * Active existing Post.
     *
     * @param  //id
     * @return //active
     */
    public function Active($id)
    {
        $post = Post::find($id);
        $post->status = 1;
        $post->save();
        $notification = array(
            'messege' => 'Post successfully activated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Inactive existing Post.
     *
     * @param  //id
     * @return //active
     */
    public function Inactive($id)
    {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();
        $notification = array(
            'messege' => 'Post successfully deactivated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
