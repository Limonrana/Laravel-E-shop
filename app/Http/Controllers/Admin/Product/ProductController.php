<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Frontend\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
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
     * Show the application product.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::paginate(10);
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.pages.product.all-products', compact('product', 'category', 'brand'));
    }

    /**
     * Show the subcategory via ajax.
     *
     * @return //subcategory data
     */
    public function ajaxSubcategory($category_id)
    {
        $subcategory = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategory);
    }

    /**
     * Show the application add product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showProductForm()
    {
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.pages.product.add-new', compact('category', 'brand'));
    }

    /**
     * Store a new product.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:85',
            'product_code' => 'required|unique:products|max:55',
            'product_quantity' => 'required',
            'category_id' => 'required|integer',
            'selling_price' => 'required',
            'short_description' => 'required|max:250',
            'featured_image' => 'required',
        ],
            [
                'category_id.integer' => 'The category field is required.',
            ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->slug = $request->slug;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->product_size = $request->product_size;
        $product->product_color = $request->product_color;
        $product->product_capacity = $request->product_capacity;
        $product->product_description = $request->product_description;
        $product->short_description = $request->short_description;
        $product->video_link = $request->video_link;
        $product->header_slider = $request->header_slider;
        $product->hot_deal = $request->hot_deal;
        $product->best_rated = $request->best_rated;
        $product->mid_slider = $request->mid_slider;
        $product->hot_new = $request->hot_new;
        $product->status = 1;

        $featured_image = $request->file('featured_image');
        $gallery_image_1 = $request->file('gallery_image_1');
        $gallery_image_2 = $request->file('gallery_image_2');

        if ($featured_image) {

            $main_image = Str::random(50) . '.' . $featured_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($featured_image)->resize(500, 500)->save(public_path('uploads/products/' . $main_image));
            $product->featured_image = 'uploads/products/' . $main_image;

        }
        if ($gallery_image_1) {

            $gallery_image1 = Str::random(50) . '.' . $gallery_image_1->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($gallery_image_1)->resize(500, 500)->save(public_path('uploads/products/' . $gallery_image1));
            $product->gallery_image_1 = 'uploads/products/' . $gallery_image1;

        }

        if ($gallery_image_2) {

            $gallery_image2 = Str::random(50) . '.' . $gallery_image_2->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($gallery_image_2)->resize(500, 500)->save(public_path('uploads/products/' . $gallery_image2));
            $product->gallery_image_2 = 'uploads/products/' . $gallery_image2;

        }

        $product->save();
        $notification = array(
            'messege' => 'Product successfully added',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product')->with($notification);
    }

    /**
     * Edit existing product.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        $subcategory = Subcategory::where('category_id', $product->category_id)->get();
        $brand      = Brand::all();
        return view('admin.pages.product.edit-product', compact('product', 'category', 'subcategory', 'brand'));
    }

    /**
     * Update existing product.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|max:85',
            'product_code' => 'required|max:55',
            'product_quantity' => 'required',
            'category_id' => 'required|integer',
            'selling_price' => 'required',
            'short_description' => 'required|max:250',
        ],
            [
                'category_id.integer' => 'The category field is required.',
            ]);

        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->slug = $request->slug;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->product_size = $request->product_size;
        $product->product_color = $request->product_color;
        $product->product_capacity = $request->product_capacity;
        $product->product_description = $request->product_description;
        $product->short_description = $request->short_description;
        $product->video_link = $request->video_link;
        $product->header_slider = $request->header_slider;
        $product->hot_deal = $request->hot_deal;
        $product->best_rated = $request->best_rated;
        $product->mid_slider = $request->mid_slider;
        $product->hot_new = $request->hot_new;

        //Old Image Link
        $old_featured_image     = $request->old_featured_image;
        $old_gallery_image_1    = $request->old_gallery_image_1;
        $old_gallery_image_2    = $request->old_gallery_image_2;

        //New Image
        $featured_image         = $request->file('featured_image');
        $gallery_image_1        = $request->file('gallery_image_1');
        $gallery_image_2        = $request->file('gallery_image_2');

        if ($featured_image) {

            unlink($old_featured_image);
            $main_image = Str::random(50) . '.' . $featured_image->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($featured_image)->resize(500, 500)->save(public_path('uploads/products/' . $main_image));
            $product->featured_image = 'uploads/products/' . $main_image;

        }
        if ($gallery_image_1) {

            if ($old_gallery_image_1) {
                unlink($old_gallery_image_1);
            }
            $gallery_image1 = Str::random(50) . '.' . $gallery_image_1->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($gallery_image_1)->resize(500, 500)->save(public_path('uploads/products/' . $gallery_image1));
            $product->gallery_image_1 = 'uploads/products/' . $gallery_image1;

        }

        if ($gallery_image_2) {

            if ($old_gallery_image_1) {
                unlink($old_gallery_image_2);
            }
            $gallery_image2 = Str::random(50) . '.' . $gallery_image_2->getClientOriginalExtension();
            // resizing an uploaded file
            Image::make($gallery_image_2)->resize(500, 500)->save(public_path('uploads/products/' . $gallery_image2));
            $product->gallery_image_2 = 'uploads/products/' . $gallery_image2;

        }

        $product->save();
        $notification = array(
            'messege' => 'Product successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product')->with($notification);
    }

    /**
     * Delete existing product.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $featured_image = $product->featured_image;
        $gallery_image_1 = $product->gallery_image_1;
        $gallery_image_2 = $product->gallery_image_2;
        if ($featured_image) {
            unlink($featured_image);
        }
        if ($gallery_image_1) {
            unlink($gallery_image_1);
        }
        if ($gallery_image_2) {
            unlink($gallery_image_2);
        }

        $product->forceDelete();
            $notification = array(
                'messege' => 'Product successfully deleted',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product')->with($notification);
    }

    /**
     * Active existing Product.
     *
     * @param  //id
     * @return //active
     */
    public function Active($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        $notification = array(
            'messege' => 'Product successfully activated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Inactive existing Product.
     *
     * @param  //id
     * @return //active
     */
    public function Inactive($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        $notification = array(
            'messege' => 'Product successfully deactivated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
